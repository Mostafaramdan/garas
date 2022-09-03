<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\school_timetables;
use App\Models\class_rooms_tables;
use App\Models\teachers;
use App\services\retrieveClassRoomTablesService;

class filterClassRoomByTeacher implements classRoomInterface
{
    public $render;
    private $id,$request;
    function __construct($id,$request)
    {
        $this->id= $id;
        $this->request=$request;
        $this->handle();
    }
    public function handle () :void
    {
        $class_rooms_tables= class_rooms_tables::where('school_timetables_id',$this->id)
                                ->with(['class_rooms_in_day','subject','teacher'])
                                ->where('teachers_id',$this->request->teachers_id)
                                ->get();
        $records= retrieveClassRoomTablesService::index($class_rooms_tables);
        if($this->request->ajax())
            $this->render= view('pages.school_timetables.class_rooms_ajax', compact('records'),['id'=>$this->id,'teacher'=>teachers::find($this->request->teachers_id)]);
        else
            $this->render=  view('pages.teachers.class_rooms', compact('records'),['id'=>$this->id,'teacher'=>teachers::find($this->request->teachers_id)]) ;
        
    }
}