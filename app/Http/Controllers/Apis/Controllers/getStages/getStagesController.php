<?php
namespace App\Http\Controllers\Apis\Controllers\getStages;

use  App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Resources\Api\stageResource;
use App\Models\stages;

class getStagesController extends index
{
    public static function api()
    {
        $stages= stages::active()->get();
        return  [
            'status'=>$stages->count()?200:204,
            'classes'=>stageResource::collection($stages),
        ];
      
    }
}
