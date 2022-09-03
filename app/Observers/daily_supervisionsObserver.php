<?php
namespace App\Observers;

use App\Models\daily_supervisions;
use App\Http\Controllers\Apis\Helper\helper;

class daily_supervisionsObserver
{
   
    function creating(daily_supervisions $daily_supervisions)
    {
        $daily_supervisions->schools_id = AuthLogged()->id;
    }
   
}
