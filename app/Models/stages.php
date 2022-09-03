<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\is_active_query;

class stages extends Model
{
    use HasFactory,is_active_query;
    protected $table = 'stages';
    protected $guarded = [] ;

    function grades()
    {
        return $this->hasMany(grades::class,'stages_id');
    }
}
