<?php

namespace App\Http\Controllers\Apis\Controllers\switchNotification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Requests\Api\switchNotificationRequest as Request;

class switchNotificationController extends index
{
    public static function api(Request $request){

        $switch= request()->account->switch_notification?0:1;
        request()->account->update(['switch_notification'=>$switch]);
        return [
            "status"=>200,
            "switch"=>(int) $switch
        ];
    }
}
