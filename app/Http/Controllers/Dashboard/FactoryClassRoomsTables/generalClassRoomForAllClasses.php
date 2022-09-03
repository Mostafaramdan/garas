<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\school_timetables;
use App\Models\class_rooms_tables;
use App\Models\classes;
use App\services\retrieveClassRoomTablesService;

class generalClassRoomForAllClasses implements classRoomInterface
{
    public string $render;
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
                                ->get();
        $records= retrieveClassRoomTablesService::index($class_rooms_tables);
        
        $this->render=  view('pages.school_timetables.generalClassRoomForAllClasses', compact('records'),[
            'id'=>$this->id,
            'class'=>classes::find($this->request->classes_id),
            'school_timetable'=>school_timetables::find($this->id)
        ]) ;
        
    }
}