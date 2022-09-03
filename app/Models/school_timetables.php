<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class school_timetables extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='school_timetables',$timestamps=false;

    function class_rooms_tables()
    {
        return $this->hasMany(class_rooms_tables::class,'school_timetables_id');
    }
}
