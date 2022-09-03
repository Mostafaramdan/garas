<?php
namespace App\Http\Controllers\Apis\Controllers\addNoteToClass;

use App\Models\notifications;
use App\Models\notify;
use App\Models\classes;
use App\Models\students;

class addNoteToClassService 
{
    public static function createNotification()
    {
        $class=classes::firstWhere(['code'=>request()->classCode]);
        return notifications::create([
            'content'    => request()->message,
            'created_at' => now(),
            'type'       => 'teacherToClass',
            'classes_id' => $class->id
        ]);
    }
    static function createNotifyforAllStudent(notifications $notification)
    {
        $class=classes::firstWhere(['code'=>request()->classCode]);
        $students= students::where('classes_id',$class->id)->get();
        foreach($students as $student)
            notify::create([
                'notifications_id' => $notification->id,
                'students_id' => $student->id,
            ]);
    }
}
