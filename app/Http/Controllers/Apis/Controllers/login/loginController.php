<?php
namespace App\Http\Controllers\Apis\Controllers\login;

use  App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Resources\Api\studentResource;
use App\Models\classes;
use App\Http\Requests\Api\loginRequest as Request;

class loginController extends index
{
    public static function api(Request $request)
    {
        return  [
            'status'=>200,
            'account'=>new (request()->resource)(request()->account),
            'message'=>self::$messages['login']['200']
        ];
      
    }
}
