<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daily_supervisions extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='daily_supervisions',$timestamps=false;

    function teacher()
    {
        return $this->belongsTo(teachers::class,'teachers_id');
    }
}
