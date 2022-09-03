<?php
namespace App\Http\Controllers\Apis\Controllers\getTeacherTable;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Requests\Api\getTeacherTableRequest;
use App\Http\Resources\Api\classRoomTableResource;
use App\Models\class_rooms_tables ;

class getTeacherTableController extends index
{
    public function api(getTeacherTableRequest $request){

        $teacherId= request()->account->id;
        $records=class_rooms_tables::where('teachers_id',$teacherId)->get();
        return [
            "status"=>$records?200:204,
            "classTable"=>classRoomTableResource::collection($records),
        ];
    }
}
