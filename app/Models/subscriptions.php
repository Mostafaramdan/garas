<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscriptions extends Model
{
    use HasFactory;
    protected $guarded = [] ;
    public $table='subscriptions',$timestamps=false,$with=['package','school'];
    
    function package()
    {
        return $this->belongsTo(packages::class,'packages_id');
    }
    function school()
    {
        return $this->belongsTo(schools::class,'schools_id');
    }
}
