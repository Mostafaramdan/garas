<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\school_timetables;
use App\Models\class_rooms_tables;
use App\Models\classes;
use App\services\retrieveClassRoomTablesService;

class filterClassRoomByClass implements classRoomInterface
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
                                ->when($this->request->classes_id,function($q){
                                    return $q->where('classes_id',$this->request->classes_id);
                                    })
                                ->get();
        $records= retrieveClassRoomTablesService::index($class_rooms_tables);
        
        $this->render=  view('pages.classes.class_rooms', compact('records'),['id'=>$this->id,'class'=>classes::find($this->request->classes_id)]) ;
        
    }
}