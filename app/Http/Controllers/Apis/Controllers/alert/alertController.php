<?php

namespace App\Http\Controllers\Apis\Controllers\alert;

use App\Http\Controllers\Apis\Controllers\index;
use  App\Http\Requests\Api\alertRequest;
use App\Models\updates_dashboard ;

class alertController extends index
{
    public function api(alertRequest $request){

        return [
            "status"=>200,
        ];
    }
}

