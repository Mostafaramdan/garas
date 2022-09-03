<?php
namespace App\Observers;

use App\Models\subjects;

class subjectObserver
{

    function creating(subjects $subject)
    {
        if(AuthLogged()->getTable() =='schools')
            $subject->schools_id= AuthLogged()->id;
    }
    function updating(subjects $subject)
    {
        if(AuthLogged()->getTable() =='schools')
            $subject->schools_id= AuthLogged()->id;
    }
    
}
