<?php
namespace App\Http\Controllers\Apis\Controllers\addNoteToClass;

use  App\Http\Controllers\Apis\Controllers\index;
use App\Models\notes;

class addNoteToClassController extends index
{
    public static function api()
    {
        notes::create([
            'notes'=>request()->note,
            'class_rooms_tables_id'=>request()->classRoomId
        ]);
    //    $notificationRecord= addNoteToClassService::createNotification();
    //    addNoteToClassService::createNotifyforAllStudent($notificationRecord);
        return  [
            'status'=>200,
        ];

    }
}
