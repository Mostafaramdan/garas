<?php
namespace App\Http\Controllers\Apis\Controllers\appSettings;

use App\Http\Controllers\Apis\Controllers\index;
use App\Models\AppSetting;
use App\Http\Resources\Api\appSettingsResource;;

class appSettingsController extends index
{
    public static function api()
    {
        $record=  AppSetting::first();
        return [
            "status"=>200,
            "info"=>new appSettingsResource($record)
        ];
    }
}