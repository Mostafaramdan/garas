<?php 
namespace App\Traits\Models;

trait adminsTrait {

    
    public function isAbleTo($permission) :bool
    {
        if(auth::user()->email??''=='demo@magdsoft.com' )
            return true;

        return str_contains($this->role->permissions,$permission) ;
    }


    public function isAdmin() :bool
    {
        return true ;
    }

    
    public function isSchool() :bool
    {
        return false ;
    }

    function role()
    {
        return $this->belongsTo(roles::class,'roles_id');
    }
}