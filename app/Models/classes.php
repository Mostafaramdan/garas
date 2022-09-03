<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\is_active_query;

class classes extends Model
{
    protected $table = 'classes';
    protected $guarded = [],$with=['grade'];
    use \Znck\Eloquent\Traits\BelongsToThrough,is_active_query;
    
    function grade()
    {
        return $this->belongsTo(grades::class,'grades_id');
    }
    public function stage()
    {
        return $this->belongsToThrough(
            stages::class,
            [grades::class, classes::class], 
            null,
            '',
            [
                classes::class => 'grades_id',
                grades::class=>'stages_id',
            ]
        );
    }
    
}
