<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\DataTables\classRoomTableDataTable;
use App\Models\school_timetables;
use App\Models\teachers;
use App\Models\subjects;
use App\Models\classes;
use App\Models\class_rooms_tables;
use App\Models\class_rooms_in_days;
use App\Models\class_rooms;
use App\services\classRoomsTableService;

use Illuminate\Support\Collection;

class ClassRoomTableController extends classRoomTableDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public  function index()
    {
        $class_rooms_tables= AuthLogged()->class_rooms_tables()->with(['class_rooms_in_day','subject','teacher'])->get();
        $records= $this->retrieve_class_room_tables($class_rooms_tables);
        return  view($this->viewPath.'index', compact('records')) ;
    }

    

    public function create()
    {        
        $teachers = \App\Models\teachers::where('is_active',1)->get();
        $subjects = \App\Models\subjects::all();
        $classes = \App\Models\classes::all();
        return view($this->viewPath.'create',compact('teachers','subjects','classes'));
    }

    public function store(CreateClassRoomRequest $request)
    {
        $this->model->create($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param school $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {       
        $classroom = $this->model->find($id);
        return view($this->viewPath.'show', compact('classroom'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $teachers = \App\Models\teachers::where('is_active',1)->get();
        $subjects = \App\Models\subjects::all();
        $classes = \App\Models\classes::all();
        $classroom = $this->model->find($id);
        return view($this->viewPath.'edit', compact('classroom','classes','subjects','teachers'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateClassRoomRequest $request, $id)
    {
        $classrooms = $this->model->find($id);
        $classrooms->update($request->except('_token', 'id'));
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }

    public function create_automatic()
    {
        $classRoomsTableService= new classRoomsTableService();
        if($classRoomsTableService->error)
            return redirect()->back()->with('error', $classRoomsTableService->error);
        // return $classRoomsTableService->class_room_tables->where('classes_id',271)->where('day','Sunday');
        return view('pages.class_rooms_tables.random',compact('classRoomsTableService'));
    }

    function save_automatic(Request $request)
    {
        if($request->id){
            $school_timetable= school_timetables::find($request->id);
            $school_timetable->update([
                'name'=>$request->name
            ]);
        }else{
            $school_timetable = school_timetables::create([
                'name'=>$request->name,
                'schools_id'=>AuthLogged()->id,
                'created_at'=>now()
            ]);
        }

        $array=[];
        for($i=0; $i<count(explode(',',$request->class_rooms_in_days_id)) ;$i++){
            $array []=[
                'class_rooms_in_days_id'=>explode(',',$request["class_rooms_in_days_id"])[$i],
                'subjects_id'=>explode(',',$request->subjects_id)[$i],
                'classes_id'=>explode(',',$request->classes_id)[$i],
                'school_timetables_id'=>$school_timetable->id,
                'teachers_id'=>explode(',',$request->teachers_id )[$i]    ,
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }
        
        AuthLogged()->increment('ClassroomTableCount');
        if($request->id){
            class_rooms_tables::where('school_timetables_id',$request->id??null)->delete();
        }
        $this->model->insert($array);

        return (route('school_timetables.show',$school_timetable->id));
    }


    public  function retrieve_class_room_tables($records)
    {
        $collection = new Collection();
        foreach($records as $record){
            $collection->push([
                'subjects_id'=>$record->subjects_id,
                'subject_name'=>$record->subject->{'name_'.session()->get('lang')},
                'dual'=>false,
                'class_rooms_in_days_id'=>$record->class_rooms_in_days_id,
                'day'=>$record->class_rooms_in_day->day,
                'class_number'=>$record->class_rooms_in_day->class_room->number,
                'classes_id'=>$record->classes_id,
                'class'=>$record->class,
                'class_room'=>$record->class_rooms_in_day->class_room,
                'className'=>$record->class->{'name_'.session()->get('lang')},
                'teachers_id'=>null
            ]);
        }
        return $collection;
    }

    function change_class_rooms(Request $request)
    {
        $class_room= class_rooms_tables::find($request->class_room_id);
        $data= explode('-',$request->day_class_num_teachId);
        $day= $data[0];
        $class_number= $data[1];

        if($class_room)
            $class_room->update([
                'subjects_id'=>$request->new_subjects_id,
                'teachers_id'=>$data[2],
            ]);
        else{
            $class_room= class_rooms::where('schools_id',AuthLogged()->id)->where('number',$class_number)->first();
            $class_rooms_in_days = class_rooms_in_days::where('day',$day)
                                            ->where('class_rooms_id',$class_room->id)->first();
            $class_room=class_rooms_tables::create([
                'school_timetables_id'=>$request->school_timetables_id,
                'teachers_id'=>$data[2],
                'class_rooms_in_days_id'=>$class_rooms_in_days->id,
                'classes_id'=>$request->classes_id,
                'subjects_id'=>$request->new_subjects_id,
            ]);
                    
            // class_rooms_tables
        }
        return $class_room;
    }


    function swap_class_rooms(Request $request)
    {
        $first=json_decode($request->first,true);
        $second=json_decode($request->second,true);

        class_rooms_tables::where('id',$first['id'])->update([
            'subjects_id'=>$first['subjects_id'],
            'teachers_id'=>$first['teachers_id'],
        ]);
        class_rooms_tables::where('id',$second['id'])->update([
            'subjects_id'=>$second['subjects_id'],
            'teachers_id'=>$second['teachers_id'],
        ]);
        abort(200);
    }
    function swap_class_room_between_two_teacher(Request $request)
    {
        $first_swap_class_room= class_rooms_tables::find($request->first_swap_class_room_id);
        $second_swap_class_room= class_rooms_tables::find($request->second_swap_class_room_id);
        
        if(!$second_swap_class_room){
            $class_room = class_rooms::whereNumber($request->class_number)
                                        ->where('schools_id',AuthLogged()->id)
                                        ->first();
            $class_rooms_in_days=    class_rooms_in_days::where('day',$request->day)
                                            ->where('class_rooms_id',$class_room->id)
                                            ->first();
            $second_swap_class_room= class_rooms_tables::create([
                'school_timetables_id'=>$first_swap_class_room->school_timetables_id,
                'classes_id'=>$first_swap_class_room->classes_id,
                'class_rooms_in_days_id'=>$class_rooms_in_days->id
            ]);
        }
        $teachers_id= $first_swap_class_room->teachers_id;
        $subjects_id= $first_swap_class_room->subjects_id;
        
        $first_swap_class_room->teachers_id= $second_swap_class_room->teachers_id;
        $first_swap_class_room->subjects_id= $second_swap_class_room->subjects_id;

        $second_swap_class_room->teachers_id= $teachers_id;
        $second_swap_class_room->subjects_id= $subjects_id;

        $first_swap_class_room->save();
        $second_swap_class_room->save();
       
    }
}

