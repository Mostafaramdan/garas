<?php 
namespace App\Traits\Models;

trait createRecordOfScholl{
    public static function boot() {

	    parent::boot();

	    static::creating(function($item) {
	        $item->schools_id= AuthLogged()->id;
	    });
	}
}