<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\class_rooms_tables;
use App\Models\teachers;
use App\services\retrieveClassRoomTablesService;

class generalClassRoomForAllTeachers implements classRoomInterface
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
                                ->get();
        $records= retrieveClassRoomTablesService::index($class_rooms_tables);

        $teachers= teachers::find($class_rooms_tables->pluck('teachers_id'));
        $this->render=  view('pages.class_rooms_tables.general_all_teachers', compact('records','teachers'),['id'=>$this->id]) ;

    }
}