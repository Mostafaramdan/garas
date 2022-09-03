<?php
namespace App\Observers;

use App\Models\classes;
use App\Models\grades;

class gradeObserver
{

    function updated(grades $grade)
    {
        if($grade->isDirty('is_active')){
            $classes= classes::where('grades_id',$grade->id)
            ->update([
                'is_active'=> $grade->is_active
            ]);
        }
    }

    
}
