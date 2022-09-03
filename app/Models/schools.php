<?php

namespace App\Models;

use App\Traits\Models\schoolsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Models\is_active_query;
use Illuminate\Database\Eloquent\Casts\Attribute;

class schools extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,schoolsTrait, is_active_query;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [] ;
    public $table = 'schools'
    // ,$with=['stages','subjects','grade_subjects','class_rooms_in_days']
    ;

    protected function lastTimeTableId(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => school_timetables::orderBy('id','desc')->first()->id??null
        );
    }
    protected function nextSubscribtionAt(): Attribute
    {
        return Attribute::make(
            get: function ()  {
                $package= $this->packages()->first();
                $subscribtion = subscriptions::where('schools_id',$this->id)->orderBy('id','desc')->first();
                if($subscribtion)
                    return $subscribtion->end_at;
                // return  date('Y-m-d', strtotime($package->created_at. " + {$package->days} days"));

            }
        );
    }
}
