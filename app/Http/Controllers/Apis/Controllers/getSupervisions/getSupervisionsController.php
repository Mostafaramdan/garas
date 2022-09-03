<?php

namespace App\Http\Controllers\Apis\Controllers\getSupervisions;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\getSupervisionsRequest;
use App\Http\Resources\Api\supervisionsResource;
use App\Models\daily_supervisions ;

class getSupervisionsController extends index
{
    public function api(getSupervisionsRequest $request){

       $records= daily_supervisions::where('schools_id',$request->schools_id)
                            ->get();
        return [
            "status"=>$records?200:204,
            "exams"=>supervisionsResource::collection($records),
        ];


    }
}

