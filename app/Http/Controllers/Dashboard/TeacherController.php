<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateTeacherRequest;
use App\Http\Requests\Dashboard\UpdateTeacherRequest;
use App\Http\Requests\Dashboard\UpdateTeacherClassRoomRequest;
use App\DataTables\TeacherDataTable;

use App\Models\teachers as model ;
use App\Models\teacher_subject;
use App\Models\classes;
use App\Models\teacher_classes;
use Illuminate\Http\Request;

class TeacherController extends TeacherDataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(TeacherDataTable $module)
    {
        return request()->ajax() ?
            $module->main() :
            view($this->viewPath . 'index', compact('module'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(CreateTeacherRequest $request)
    {
        $teacher = $this->model->create($request->only(['name','phone','custom_class_room_in_day']));
        
        foreach ($request->subject_ids as $subject_id) {
            teacher_subject::create(['subjects_id' => $subject_id, 'teachers_id' => $teacher->id]);
        }

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route('teachers.index');
    }

    /**
     * Show the specified resource.
     * @param Teachers $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $teacher)
    {       
        return view($this->viewPath . 'show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $teacher)
    {
        return view($this->viewPath . 'edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateTeacherRequest $request, model $teacher)
    {
        $teacher->update($request->except('subject_ids'));
        teacher_subject::where('teachers_id' , $teacher->id)->delete();
        foreach ($request->subject_ids as $subject_id) {
            $teacher->teacher_subject()->create(['subjects_id' => $subject_id]);
        }
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route('teachers.index');
    }

    public function customizeIndex(Request $request, model $teacher)
    {
        $classes= AuthLogged()->classes()->where('classes.is_active',1)->get();
        return view('pages.teachers.customize.updateOrCreate',compact('classes','teacher'));
                        // ->whereIn('id')
    }

    
    public function updateTeacherCustomize(Request $request,model $teacher)
    {
        $class_rooms_in_days_for_teacher= collect(json_decode($teacher->custom_class_room_in_day,true));
        // if($class_rooms_in_days_for_teacher->count() != $request->max_class_rooms){
        //     return back()->with('error',__('max_class_rooms_not_match'));
        // }
        $teacher->update(['max_class_rooms'=>$request->max_class_rooms,'max_waiting_class_rooms'=>$request->max_waiting_class_rooms]);
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route('teachers.index');
    }
   
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function teacherAssignmentIndex(Request $request, model $teacher)
    {
        $teacher->load(['subjects','subjects.grades','teacher_classes']);
        $classOfGrades=collect([]);
        foreach ($teacher->subjects as $subject) {
            foreach ($subject->grades as $grade) {
                // check if the class is already assigned to the teacher
                $classOfGrades->push([
                    'grades_id'=>$grade->id,
                    'grade_name'=>$grade->{'name_'.__('currentLang') },
                    'classes'=>classes::active()->where('grades_id',$grade->id)->get(['id','name_'.__('currentLang')])
                ]);
            }
        }
        return view('pages.teachers.assignment.updateOrCreate',compact('teacher','classOfGrades'));
    }

    public function AssignmentUpdate(Request $request, model $teacher)
    {
        $teachers_class=[];
        foreach ($request->assignmentClass as $assignment) {
            $teachers_class[]=[
                'subjects_id'=>explode('subjectId=', $assignment)[1],
                'classes_id'=>explode('-',explode('classId=', $assignment)[1])[0],
                'teachers_id'=>$teacher->id
            ];
        }
        $count_class_room=0;
        foreach ($teachers_class as $teacher_class) {
            $subject = classes::find($teacher_class['classes_id'])
                        ->grade->grade_subject->where('subjects_id',$teacher_class['subjects_id'])
                        ->first();
            $count_class_room+=   ($subject->matrimonial_portions*2) + ($subject->individual_portions);  
        }
        if($teacher->max_class_rooms < $count_class_room){
            return back()->with('error',__('total classrooms of selected subjects is :count and total classrooms of this teacher is :class_rooms_in_days_for_teacher',['count'=>$count_class_room,'class_rooms_in_days_for_teacher'=>$teacher->max_class_rooms]));
        }
        teacher_classes::where('teachers_id' , $teacher->id)->delete();
        teacher_classes::insert($teachers_class);


        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route('teachers.index');
    }
    
    public function custom_class_room_in_day(model $teacher,$class_rooms_in_days_id )
    {
        $class_rooms_in_days_for_teacher= collect(json_decode($teacher->custom_class_room_in_day,true));
        if(!$class_rooms_in_days_for_teacher->contains($class_rooms_in_days_id)){
            $class_rooms_in_days_for_teacher->push($class_rooms_in_days_id);
            $teacher->update(['custom_class_room_in_day'=>json_encode($class_rooms_in_days_for_teacher)]);
        }else{
            $class_rooms_in_days_for_teacher= $class_rooms_in_days_for_teacher->filter(function ($value, $key) use ($class_rooms_in_days_id) {
                return $value != $class_rooms_in_days_id;
            });
            $teacher->update(['custom_class_room_in_day'=>json_encode($class_rooms_in_days_for_teacher->all())]);
        }
    }
}

