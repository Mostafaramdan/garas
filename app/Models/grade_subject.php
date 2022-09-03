<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade_subject extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='grade_subject',$timestamps=false;
    public $appends=['totalClassRooms'];
    
    function subject()
    {
        return $this->belongsTo(subjects::class,'subjects_id');
    }

    function GetTotalClassRoomsAttribute()
    {
        return ($this->matrimonial_portions*2) + ($this->individual_portions) ;
    }
}
