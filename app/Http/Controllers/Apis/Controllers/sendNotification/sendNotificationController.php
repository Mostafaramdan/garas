<?php
namespace App\Http\Controllers\Apis\Controllers\sendNotification;

use  App\Http\Controllers\Apis\Controllers\index;
use App\Notifications\notificationController;
use  App\Http\Requests\Api\sendNotificationRequest;
use App\Models\classes;
use App\Models\students;

class sendNotificationController extends index
{
    public static function api(sendNotificationRequest $request)
    {
        $class = classes::find($request->classId);

        $students = students::where('classes_id', $class->id)->get();

        $notificationController = new notificationController(
            $students,
            ['content'=>$request->message],
            ['type'=>'teacherToClass','teachers_id'=>request()->account->id]
        );
        
        return  [
            'status'=>200,
        ];
      
    }
}
