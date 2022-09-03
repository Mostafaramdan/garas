<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exams_table extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='exams_table',$timestamps=false;

    function grade()
    {
        return $this->belongsTo(grades::class,'grades_id');
    }

    function subject()
    {
        return $this->belongsTo(subjects::class,'subjects_id');
    }
}
