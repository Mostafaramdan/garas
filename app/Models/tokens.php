<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tokens extends Model
{
    use HasFactory;

    protected $table = 'tokens';
    protected $guarded = [] ;

    function teacher()
    {
        return $this->belongsTo(teachers::class,'teachers_id');
    }
    function student()
    {
        return $this->belongsTo(students::class,'students_id');
    }

}
