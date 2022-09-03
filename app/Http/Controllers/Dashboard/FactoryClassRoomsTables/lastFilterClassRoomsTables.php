<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\school_timetables;
use App\Models\class_rooms_tables;
use App\services\retrieveClassRoomTablesService;

class lastFilterClassRoomsTables implements classRoomInterface
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
        $days= $records->unique('day')->pluck('day');
        $first_day= $records->unique('day')->pluck('day')->first();
        $records= $records->where('day',$first_day);
        $this->render = view('pages.school_timetables.lastClassRooms', compact('records'),['id'=>$this->id,'days'=>$days,'first_day'=>$first_day]) ;
        
    }
}