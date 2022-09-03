<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\class_rooms_tables;
use App\services\retrieveClassRoomTablesService;

class generalClassRoomTables implements classRoomInterface
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
        $this->render=  view('pages.class_rooms_tables.general', compact('records'),['id'=>$this->id]) ;

    }
}