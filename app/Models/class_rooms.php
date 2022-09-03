<?php

namespace App\Models;
use App\Traits\Models\getRecordOfScholl;
use App\Traits\Models\createRecordOfScholl;
use App\Traits\Models\is_active_query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class class_rooms extends Model
{
    use HasFactory,getRecordOfScholl,createRecordOfScholl,is_active_query;
    protected $table = 'class_rooms',$guarded = [];

	public function class_rooms_in_days()
	{
		return $this->hasMany(class_rooms_in_days::class,'class_rooms_id');
	}
}