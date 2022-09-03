<?php

namespace App\Http\Controllers\Apis\Controllers\getSubjects;

use App\Http\Controllers\Apis\Controllers\index;
use Illuminate\Support\Facades\Validator;
use  App\Http\Requests\Api\getSubjectsRequest;

class getSubjectsRules extends index
{

    public static function rules ()
    {   
        $getSubjectsRequest= new getSubjectsRequest(request()->all());
        $validator=  Validator::make(
            request()->all(),
            $getSubjectsRequest->rules(),
            self::$lang=='ar'?$getSubjectsRequest->messages():[]
        );
        if($validator->fails()){
            return [
                'status'=>'error',
                'errors'=>$validator->errors()
            ];
        }
        $getSubjectsRequest->checkForToken();

    }
}
