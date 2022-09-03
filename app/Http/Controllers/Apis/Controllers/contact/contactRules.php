<?php

namespace App\Http\Controllers\Apis\Controllers\contact;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\contactRequest;
use Illuminate\Support\Facades\Validator;

class contactRules extends index
{

    public static function rules ()
    {   
        $contactRequest = new contactRequest(request()->all());
        $validator=  Validator::make(
            request()->all(),
            $contactRequest->rules(),
            self::$lang=='ar'?$contactRequest->messages():[]
        );
        if($validator->fails()){
            return [
                'status'=>'error',
                'errors'=>$validator->errors()
            ];
        }
        $contactRequest->validateAccount();
    }
}
