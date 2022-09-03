<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notify extends Model
{
    use HasFactory;
    protected $table = 'notify';
    protected $guarded = [];

    function notification()
    {
        return $this->belongsTo(notifications::class,'notifications_id');
    }

   
}
