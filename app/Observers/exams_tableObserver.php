<?php
namespace App\Observers;

use App\Models\exams_table;

class exams_tableObserver
{

    function creating(exams_table $exams_table)
    {
        if(AuthLogged()->getTable() =='schools')
            $exams_table->schools_id= AuthLogged()->id;
    }
    function updating(exams_table $exams_table)
    {
        if(AuthLogged()->getTable() =='schools')
            $exams_table->schools_id= AuthLogged()->id;
    }
    
}
