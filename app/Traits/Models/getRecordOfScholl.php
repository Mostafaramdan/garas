<?php 
namespace App\Traits\Models;

trait getRecordOfScholl{
    public function scopeSchool($query,$schoolId=null)
    {
        return $query->where('schools_id', $schoolId??AuthLogged()->id);
    }
}