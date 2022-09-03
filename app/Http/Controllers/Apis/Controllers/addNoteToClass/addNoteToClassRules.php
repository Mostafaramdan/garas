<?php

namespace App\Http\Controllers\Apis\Controllers\addNoteToClass;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\addNoteToClassRequest;
use Illuminate\Support\Facades\Validator;

class addNoteToClassRules extends index
{

    public static function rules ()
    {   
        $addNoteToClassRequest = new addNoteToClassRequest(request()->all());
        $validator=  Validator::make(
            request()->all(),
            $addNoteToClassRequest->rules(),
            self::$lang=='ar'?$addNoteToClassRequest->messages():[]
        );
        if($validator->fails()){
            return [
                'status'=>'error',
                'errors'=>$validator->errors()
            ];
        }
        $addNoteToClassRequest->checkForToken();
    }
}
