<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packages extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='packages',$timestamps=false;
    function packeges()
    {
        
    }
}
