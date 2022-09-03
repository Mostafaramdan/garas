<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grades extends Model
{
    protected $table = 'grades';
    public $appends=['stageName'];
    protected $guarded = [],$with=['stage','grade_subject'];
    use \App\Traits\Models\is_active_query;
    
    function stage()
    {
        return $this->belongsTo(stages::class, 'stages_id');
    }

    function grade_subject()
    {
        return $this->hasMany(grade_subject::class, 'grades_id');
    }

    function classes()
    {
        return $this->hasMany(classes::class, 'grades_id');
    }
   

    function GetStageNameAttribute()
    {
        if($this->stage)
            return $this->stage->{'name_'.\Config::get('app.locale') };
    }
}
