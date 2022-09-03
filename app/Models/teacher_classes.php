<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher_classes extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='teacher_classes',$timestamps=false;
    
    function teacher()
    {
        return $this->belongsTo(teachers::class,'teachers_id');
    }
}
