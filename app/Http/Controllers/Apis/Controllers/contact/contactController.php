<?php
namespace App\Http\Controllers\Apis\Controllers\contact;

use  App\Http\Controllers\Apis\Controllers\index;
use App\Models\contacts;
class contactController extends index
{
    public static function api()
    {

        contacts::create([
            request()->account->getTable().'_id'=>request()->account->id,
            'name'=>request()->name,
            'message'=>request()->message
        ]);
        return  [
            'status'=>200,
        ];
      
    }
}
