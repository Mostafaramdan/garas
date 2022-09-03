<?php
namespace App\Http\Controllers\Apis\Controllers\getTeachers;

use  App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Resources\Api\teacherResource;
use App\Models\teachers;

class getTeachersController extends index
{
    public static function api()
    {
        $teachers= teachers::where('is_active',1)
                        ->when(request()->subjectId,function($q){
                            return $q->whereHas('teacher_subject',function($q){
                                return $q->where('subjects_id',request()->subjectId);
                            });
                        })    
                        ->get();
        return  [
            'status'=>$teachers->count()?200:204,
            'classes'=>teacherResource::collection($teachers),
        ];
      
    }
}
