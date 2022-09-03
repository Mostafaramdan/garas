<?php
namespace App\Http\Controllers\Apis\Controllers\getClasses;

use  App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Resources\Api\classResource;
use App\Models\classes;

class getClassesController extends index
{
    public static function api()
    {
        $classes= classes::active();
        return  [
            'status'=>$classes->count()?200:204,
            'classes'=>classResource::collection($classes->get()),
        ];
    }
}
