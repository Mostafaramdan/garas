<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher_subject extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='teacher_subject',$timestamps=false;
    
    function teacher()
    {
        return $this->belongsTo(teachers::class,'teachers_id');
    }
}
