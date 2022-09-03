<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class class_rooms_in_days extends Model
{
    use HasFactory;
    protected $table = 'class_rooms_in_days',$guarded = [],$with=['class_room'];
	public $timestamps=false;
    public function class_room()
    {
        return $this->belongsTo(class_rooms::class,'class_rooms_id');
    }
    
}