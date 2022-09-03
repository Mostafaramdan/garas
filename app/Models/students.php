<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough  ;

    public $table = 'students';
    protected $guarded = [],$observables=['createToken'];
    public function createToken()
    { 
        $this->fireModelEvent('createToken', false);
        return $this;
    }

    public function class()
    {
        return $this->belongsTo(classes::class,'classes_id');
    }

    public function scopeSchool($query)
    {
        return $query->whereHas('class',function($q){
            return $q->whereHas('grade',function($q){
                return $q->whereHas('stage',function($q){
                    return $q->where('schools_id',AuthLogged()->id);
                });
            });
        });
    }
}
 