<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class class_rooms_tables extends Model
{

    protected $table = 'class_rooms_tables',$with=['subject','teacher','class','class_rooms_in_day'];
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(teachers::class, 'teachers_id');
    }
    public function notes()
    {
        return $this->hasMany(notes::class, 'class_rooms_tables_id');
    }

    public function subject()
    {
        return $this->belongsTo(subjects::class,'subjects_id');
    }
    public function class()
    {
        return $this->belongsTo(classes::class,'classes_id');
    }

    public function class_rooms_in_day()
    {
        return $this->belongsTo(class_rooms_in_days::class,'class_rooms_in_days_id');
    }
}
