<?php 

namespace App\services;
use App\Models\schools;
use App\Models\packages;
use App\Models\subscriptions;
use App\Models\stages;
use App\Models\classes;
use App\Models\class_rooms;
use App\Models\class_rooms_in_days;
use App\Traits\services\create_default_stages_and_grades;
use App\Traits\services\create_default_subjects;

class schoolService {

    use create_default_stages_and_grades,create_default_subjects;
    function __construct(schools $school,$request)
    {
        $this->school= $school;
        $this->request= $request;
        $this->create_default();
    }

    private function create_default()
    {
        $this->school->refresh();
        $this->create_default_stages_and_grades();
        $this->create_classes();
        $this->create_classRooms();
        $this->create_default_subjects();
        $this->create_demo_package();
    }


    private function create_classes()
    {
        $this->school= $this->school->fresh();
        foreach($this->school->grades as $grade){
            for($i=1;$i<3;$i++)
            classes::create([
                'grades_id'=>$grade->id,
                'name_ar'=>"{$i}/{$grade->name_ar}",
                'name_en'=>"{$i}/{$grade->name_en}",
                'code'=>UniqueRandomXDigits(5,'code',['classes'])
            ],[
                'name_ar'=>"{$i}/{$grade->name_ar}",
                'name_en'=>"{$i}/{$grade->name_en}",
                'code'=>UniqueRandomXDigits(5,'code',['classes'])

            ]);
        }
    }

    private function create_classRooms()
    {
        $class_rooms=[];
        for($i=1;$i<=$this->school->Classrooms_Count; $i++){
            $class_rooms[]=[
                'start_at'=>date( "h:i:s", strtotime( "07:00:00 +".(40*($i-1))." minutes" ) ),
                'end_at'=>date( "h:i:s", strtotime( "07:00:00 +".(40*($i))." minutes" ) ),
                'number'=>$i,
                'schools_id'=>$this->school->id,
            ];
        }
        $class_rooms = class_rooms::insert($class_rooms);
        $this->school->refresh();
        
        // create class_rooms_in_days
        $class_rooms_in_days=[];
        foreach($this->school->days() as $day){
            foreach($this->school->class_rooms as $class_room)
            $class_rooms_in_days[]=[
                'day'=>$day,
                'class_rooms_id'=>$class_room->id,
            ];
        }
        class_rooms_in_days::insert($class_rooms_in_days);

    }

    private function create_demo_package()
    {
        $demo_package = packages::where('name_en','like','%demo%')->first();
        if($demo_package){
            subscriptions::create([
                'packages_id'=>$demo_package->id,
                'schools_id'=>$this->school->id,
                'created_at'=>now(),
                'subscribed_at'=>now(),
                'price'=>$demo_package->price,
                'end_at'=>date('Y-m-d', strtotime(now(). " + {$demo_package->days} days"))
            ]);
        }
    }
   
    
}