<?php
namespace App\Observers;

use App\Models\class_rooms_tables;

class classRoomTableObserver
{
    function retrieved(class_rooms_tables $record)
    {
        // $record->teacherName= $record->teacher()->first()->name;
        // $record->subjectName= $record->subject()->first()->name_ar;
        // $record->className= $record->class()->first()->name_ar;
    }
    function updating(class_rooms_tables $record)
    {
        unset($record->teacherName)  ;
        unset($record->subjectName)  ;
        unset($record->className)  ;
    }
}
