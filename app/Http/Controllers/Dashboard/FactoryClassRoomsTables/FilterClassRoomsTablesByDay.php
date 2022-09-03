<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\school_timetables;
use App\Models\class_rooms_tables;
use App\services\retrieveClassRoomTablesService;

class FilterClassRoomsTablesByDay implements classRoomInterface
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
                                // ->whereHas('class_rooms_in_day',function($q) {
                                //     return $q->where('day',$this->request->day);
                                // })
                                ->get();


        $records= retrieveClassRoomTablesService::index($class_rooms_tables);
         $this->render = view('pages.class_rooms_tables.filter', compact('records'),['id'=>$this->id,'day'=>$this->request->day]) ;
    }
}