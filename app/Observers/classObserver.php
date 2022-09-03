<?php
namespace App\Observers;

use App\Models\classes;

class classObserver
{
   

    function updating(classes $record)
    {
        unset($record->gradeName)  ;
    }

    function creating(classes $class)
    {
        $class->code= UniqueRandomXDigits(5,'code',['classes']);
    }
}
