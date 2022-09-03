<?php

namespace App\Http\Controllers\Apis\Controllers\unseenNotifications;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Apis\Controllers\index;
use App\Models\notify;
use App\Http\Requests\Api\unseenNotificationRequest as Request;

class unseenNotificationsController extends index
{
    public static function api(Request $request){

        $unseen=  notify::where(self::$account->getTable().'_id',self::$account->id)->where('is_seen',0)->count();
        return [
            "status"=>200,
            "count"=>(int) $unseen
        ];
    }
}
