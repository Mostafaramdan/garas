<?php

namespace App\Http\Controllers\Apis\Controllers\logOut;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Apis\Controllers\index;
use App\Models\tokens;
use App\Http\Requests\Api\logOutRequest as Request;

class logOutController extends index
{
    public static function api(Request $request)
    {
        tokens::where('apiToken',request()->apiToken)->delete();
        !request()->logoutFromAllDevice? :self::logoutFromAllDevice();
        return [
            "status"=>200,
        ];
    }

    static function logoutFromAllDevice()
    {
        tokens::where(request()->account->getTable().'_id',request()->account->id)
                ->delete();

    }
}
