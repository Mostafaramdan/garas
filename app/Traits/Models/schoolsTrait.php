<?php 
namespace App\Traits\Models;

use App\Models\stages;
use App\Models\subjects;
use App\Models\grade_subject;
use App\Models\grades;
use App\Models\class_rooms_in_days;
use App\Models\class_rooms;
use App\Models\classes;
use App\Models\teacher_classes;
use App\Models\roles;
use App\Models\teachers;
use App\Models\class_rooms_tables;
use App\Models\packages;
use App\Models\school_timetables;
use App\Models\subscriptions;

trait schoolsTrait {

    function role()
    {
        return $this->belongsTo(roles::class,'roles_id');
    }

    function packages()
    {
        return $this->belongsToMany(packages::class, 'subscriptions',  'schools_id','packages_id')->latest();;
    }

    public function lastSubscription() 
    {
        return $this->hasOne(subscriptions::class,'schools_id')->orderBy('id','desc')->limit(1);;
    }
    

    public function isAdmin() :bool
    {
        return false ;
    }

    public function isSchool() :bool
    {
        return true ;
    }

    function maxClassRoom()
    {
        $total=$this->Classrooms_Count*7;
        $total += $this->day_off1? -$this->Classrooms_Count:0;
        $total += $this->day_off2? -$this->Classrooms_Count:0;
        return $total;
    }

    function days()
    {
        $days=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        $days= !$this->day_off1?$days:array_diff($days,[$this->day_off1]);
        $days= !$this->day_off2?$days:array_diff($days,[$this->day_off2]);
        return $days;
    }

    function class_rooms_in_days()
    {
        return $this->hasManyDeep(class_rooms_in_days::class, [class_rooms::class]);
    }

    function class_rooms_tables()
    {
        return $this->hasManyDeep(class_rooms_tables::class, [class_rooms::class,class_rooms_in_days::class]);
    }

    function classes()
    {
        return $this->hasManyDeep(classes::class, [stages::class,grades::class]);
    }
    function exams_table()
    {
        return $this->hasManyDeep(exams_table::class, [stages::class,grades::class]);
    }

    function grade_subjects()
    {
        return $this->hasManyDeep(grade_subject::class, [stages::class,grades::class]);
    }

    function class_rooms()
    {
        return $this->hasMany(class_rooms::class,'schools_id');
    }

    function teachers()
    {
        return $this->hasMany(teachers::class,'schools_id');
    }

    function grades()
    {
        return $this->hasManyThrough( grades::class,stages::class,'schools_id','stages_id');
    }

    function teacher_classes()
    {
        return $this->hasManyDeep(teacher_classes::class, [teachers::class]);

    }

    function subjects()
    {
        return $this->hasMany(subjects::class,'schools_id');

    }
    function stages()
    {
        return $this->hasMany(stages::class, 'schools_id');
    }


    function school_timetables()
    {
        return $this->hasMany(school_timetables::class,'schools_id');
    }

}