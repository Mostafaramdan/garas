<?php
namespace App\Http\Controllers\Apis\Controllers\getSubjects;

use  App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Resources\Api\subjectResource;
use App\Models\classes;

class getSubjectsController extends index
{
    public static function api()
    {
        $subjects= request()->account->subjects;
        return  [
            'status'=>$subjects->count()?200:204,
            'classes'=>subjectResource::collection($subjects),
        ];
      
    }
}
