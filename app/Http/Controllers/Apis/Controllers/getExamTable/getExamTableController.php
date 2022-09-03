<?php

namespace App\Http\Controllers\Apis\Controllers\getExamTable;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\getExamTableRequest;
use App\Http\Resources\Api\examTableResource;
use App\Models\exams_table ;

class getExamTableController extends index
{
    public function api(getExamTableRequest $request)
    {
       $records= exams_table::where('schools_id',$request->schools_id)
                    ->when($request->stageId,function($q) use ($request){
                        return $q ->whereHas('grade',function($q) use ($request){
                            return $q->where('stages_id',$request->stageId);
                        });
                    })
                    ->get();
        return [
            "status"=>$records?200:204,
            "exams"=>examTableResource::collection($records),
        ];


    }
}

