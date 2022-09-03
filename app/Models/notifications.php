<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class notifications extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $guarded = [];
    protected function typeTranslated (): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->translateType()
        );
    }

    protected function target (): Attribute
    {
        return Attribute::make(
            get: function ($value){
                return $this->teacher??$this->school??$this->admin;
            }
        );
    }
   
    function student()
    {
        return $this->belongsTo(students::class,'students_id');
    }

    function teacher()
    {
        return $this->belongsTo(teachers::class,'teachers_id');
    }

    function school()
    {
        return $this->belongsTo(schools::class,'schools_id');
    }

    function admin()
    {
        return $this->belongsTo(admins::class,'admins_id');
    }   
    
    
    private function translateType()
    {
        
        switch($this->attributes['type']){
            case 'teacherToClass': 
                $type = __('api.teacherToClass',['className'=>$this->target->name??'']);
            break;
            case 'schoolToClass': 
                $type = __('api.schoolToClass',['className'=>$this->target->name??'']);
            break;
            case 'schoolToTeacher': 
                $type = __('api.schoolToTeacher',['className'=>$this->target->name??'']);
            break;
            case 'adminToteachers': 
                $type = __('api.adminToteachers',['teacherName'=>$this->target->name??'']);
            break;
            case 'adminToteachers': 
                $type = __('api.adminToteachers',['className'=>$this->target->name??'']);
            break;
            default: 
                $type = __('api.adminToteachers',['className'=>$this->target->name??'']);
            break;
        }
        return $type;
    }
    
}
