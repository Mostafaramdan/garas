<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    protected $table = 'contacts';
    protected $guarded = [];

    // this query will filter contact , retrieve only relate to this school
    public function scopeSchool($query)
    {
        return $query->whereHas('teacher', function($q){
    
            return $q->where('schools_id',AuthLogged()->id);
    
        })
        ->orWhereHas('student', function($q){
    
            return $q->school();
    
        });
    }

    function teacher()
    {
        return $this->belongsTo(teachers::class,'teachers_id');
    }

    function student()
    {
        return $this->belongsTo(students::class,'students_id');
    }
}
