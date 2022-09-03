<?php

namespace App\Http\Controllers\Apis\Controllers\getCommingSoon;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\getCommingSoonRequest;
use App\Http\Resources\Api\commingSoonResource;
use App\Models\updates_dashboard ;

class getCommingSoonController extends index
{
    public function api(getCommingSoonRequest $request){

       $records= updates_dashboard::where('type','application')
                            ->get();
        return [
            "status"=>$records?200:204,
            "exams"=>commingSoonResource::collection($records),
        ];


    }
}

