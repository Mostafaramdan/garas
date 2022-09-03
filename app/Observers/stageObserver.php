<?php
namespace App\Observers;

use App\Models\classes;
use App\Models\grades;
use App\Models\stages;

class stageObserver
{

    function updated(stages $stage)
    {
        if($stage->isDirty('is_active')){
            $grades= grades::where('stages_id',$stage->id);
            $grades->update([
                'is_active'=> $stage->is_active
            ]);
            $classes= classes::whereIn('grades_id',$grades->pluck('id'))
            ->update([
                'is_active'=> $stage->is_active
            ]);
        }
    }
    function creating(stages $stage)
    {
        if(AuthLogged()->getTable() =='schools')
            $stage->schools_id= AuthLogged()->id;
    }
    
}
