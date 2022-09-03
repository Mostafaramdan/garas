<?php 
namespace App\services;

use App\Models\schools;
use App\Models\class_rooms;
use App\Models\class_rooms_in_days;

class classRoomsService {

    function __construct(schools $school)
    {
        $this->school= $school;
    }
    public function update_classRooms()
    {
        $school= $this->school->refresh();
        if (!$school->wasChanged('Classrooms_Count')) return ;


        $current_Classrooms_Count= $school->class_rooms->where('is_active',1)->count() - $school->Classrooms_Count;

        if($current_Classrooms_Count > 0){
            $class_rooms= $school->class_rooms->sortByDesc('number')
                                        ->where('number','>',$school->Classrooms_Count);

            class_rooms::whereIn('id',$class_rooms->pluck('id'))->update(['is_active'=>0]);
            class_rooms_in_days::whereIn('class_rooms_id',$class_rooms->pluck('id'))->update(['is_active'=>0]);
        }else{
            for($i=1;$i<=$school->Classrooms_Count; $i++){
                class_rooms::updateOrCreate([
                    'number'=>$i,
                    'schools_id'=>$this->school->id,
                ],[
                    'start_at'=>date( "h:i:s", strtotime( $school->start_day.   " +".(40*($i-1))." minutes" ) ),
                    'end_at'=>date( "h:i:s", strtotime( $school->start_day. " +".(40*($i))." minutes" ) ),
                    'is_active'=>1
                ]);
            }
            $school->refresh();
            
            // create class_rooms_in_days
            $class_rooms_in_days=[];
            foreach($this->school->days() as $day){
                foreach($this->school->class_rooms as $class_room)
                class_rooms_in_days::updateOrCreate([
                    'day'=>$day,
                    'class_rooms_id'=>$class_room->id,
                ],[
                    'is_active'=>1
                ]);
            }
        }

    }    
}