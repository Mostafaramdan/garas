<?php
namespace App\Http\Controllers\Apis\Controllers\getGrades;

use  App\Http\Controllers\Apis\Controllers\index;
use App\Models\grades;
use App\Http\Requests\Api\getGradesRequest;
use App\Http\Resources\Api\gradeResource;

class getGradesController extends index
{
    public static function api(getGradesRequest $request)
    {
        $records= grades::when($request->stageId,function($q) use($request){
            return $q->where('stages_id',$request->stageId);
        })->get();

        return  [
            'status'=>200,
            'grades'=>gradeResource::collection($records)
        ];

    }
}
