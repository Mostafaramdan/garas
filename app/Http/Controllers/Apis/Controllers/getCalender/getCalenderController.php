<?php

namespace App\Http\Controllers\Apis\Controllers\getCalender;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\getExamTableRequest;
use App\Http\Resources\Api\calenderResource;
use App\Models\school_calendar ;

class getCalenderController extends index
{
    public function api(getExamTableRequest $request){

       $records= school_calendar::all();
        return [
            "status"=>$records?200:204,
            "calenders"=>calenderResource::collection($records),
        ];


    }
}

