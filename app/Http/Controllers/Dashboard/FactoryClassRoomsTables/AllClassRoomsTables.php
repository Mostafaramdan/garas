<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\class_rooms_tables;
use App\Models\school_timetables;
use App\services\retrieveClassRoomTablesService;

class AllClassRoomsTables implements classRoomInterface
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
        $this->render=  view('pages.class_rooms_tables.index', compact('records'),['id'=>$this->id,'name'=>school_timetables::find($this->id)->name]) ;

    }
}