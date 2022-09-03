<?php

namespace App\Http\Controllers\Apis\Controllers\setFireBaseToken;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Apis\Controllers\index;
use App\Models\notify;
use App\Http\Requests\Api\setFireBaseTokenRequest as Request;

class setFireBaseTokenController extends index
{
    public static function api(Request $request){

        request()->account->update(['firebaseToken'=>request()->firebaseToken]);
        return [
            "status"=>200,
        ];
    }
}
