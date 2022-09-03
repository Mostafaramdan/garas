<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teachers extends Model
{
    use HasFactory;

    public $table = 'teachers';
    protected $guarded = [] ;
    protected $observables = ['createToken'];


    function subjects()
    {
        return $this->belongsToMany(subjects::class, 'teacher_subject',  'teachers_id','subjects_id');
    }

    

    function classes()
    {
        return $this->belongsToMany(classes::class, 'teacher_classes',  'teachers_id','classes_id');
    }
    
    function teacher_subject()
    {
        return $this->hasMany(teacher_subject::class,'teachers_id');
    }

    function teacher_classes()
    {
        return $this->hasMany(teacher_classes::class,'teachers_id');
    }
    
    public function createToken()
    { 
        $this->fireModelEvent('createToken', false);
        return $this;
    }
}
