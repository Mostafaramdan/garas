<?php
namespace App\Http\Controllers\Apis\Controllers\getTeachers;

use App\Http\Controllers\Apis\Controllers\index;

use Illuminate\Support\Facades\Validator;
use  App\Http\Requests\Api\getTeachersRequest;

class getTeachersRules extends index
{

    public static function rules ()
    {   
        $getTeachersRequest= new getTeachersRequest(request()->all());
        $validator=  Validator::make(
            request()->all(),
            $getTeachersRequest->rules(),
            self::$lang=='ar'?$getTeachersRequest->messages():[]
        );
        if($validator->fails()){
            return [
                'status'=>'error',
                'errors'=>$validator->errors()
            ];
        }
        $getTeachersRequest->checkForToken();
    }
}
