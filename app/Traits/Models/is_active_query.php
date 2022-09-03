<?php 
namespace App\Traits\Models;

trait is_active_query{
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
}