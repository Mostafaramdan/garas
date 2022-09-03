<?php

namespace App\Http\Controllers\Apis\Controllers\getClassTable;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\getClassTableRequest;
use App\Http\Resources\Api\classRoomTableResource;
use App\Models\class_rooms_tables ;
use App\Models\schools ;
use App\Models\school_timetables ;

class getClassTableController extends index
{
    public function api(getClassTableRequest $request)
    {
        $schoolId= schools::whereHas('classes',function($q){
            return $q->where('classes.id',request()->classId);
        })->first()->id ;

        $school_timetable= school_timetables::where('schools_id',$schoolId)->latest()->first();
        $records=class_rooms_tables::where('classes_id',request()->classId)
                            ->with(['class_rooms_in_day','class_rooms_in_day.class_room'])    
                            ->whereschool_timetables_id($school_timetable->id)
                            ->get();
        return [
            "status"=>$records?200:204,
            'count'=>$records->count(),
            "classTable"=>classRoomTableResource::collection($records),
        ];


    }
}

