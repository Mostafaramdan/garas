<?php
namespace App\Observers;

use App\Models\class_rooms;
use App\Models\class_rooms_in_days;

class classRoomObserver
{
    function creating(class_rooms $record)
    {
        $record->schools_id= AuthLogged()->id;
    }
    function created(class_rooms $record)
    {
        $days = AuthLogged()->days();
        foreach($days as $day){
            class_rooms_in_days::updateOrCreate([
                'class_rooms_id'=>$record->id,
                'day'=>$day
            ],[
                'is_active'=>1,
            ]);

        }
    }
    

}
