<?php

namespace App\Http\Controllers\Apis\Controllers\getStages;

use App\Http\Controllers\Apis\Controllers\index;
use Illuminate\Support\Facades\Validator;
use  App\Http\Requests\Api\getStagesRequest;

class getStagesRules extends index
{
    public static function rules ()
    {   
        $getStagesRequest= new getStagesRequest(request()->all());
        $validator=  Validator::make(
            request()->all(),
            $getStagesRequest->rules(),
            self::$lang=='ar'?$getStagesRequest->messages():[]
        );
        if($validator->fails()){
            return [
                'status'=>'error',
                'errors'=>$validator->errors()
            ];
        }
        $getStagesRequest->checkForToken();
    }
}
