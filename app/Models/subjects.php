<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $guarded = [];

    function grades()
    {
        return $this->belongsToMany(grades::class, 'grade_subject',  'subjects_id','grades_id');
    }
}
