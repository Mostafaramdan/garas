<?php
namespace App\services;

use Illuminate\Support\Collection;
use App\Models\teachers;

class retrieveClassRoomTablesService {

    static function index($records)
    {
        $teacher_classes=AuthLogged()->teacher_classes;
        $teachers=AuthLogged()->teachers;


        $collection = new Collection();
        foreach($records as $record){
            $teachers_id= $teacher_classes->where('classes_id',$record->classes_id)->where('subjects_id',$record['subjects_id'])->first()->teachers_id??null;
            $teacher_name= $teachers->where('id',$teachers_id)->first()->name??null;
    
            $collection->push([
                'ID_'=>rand(1,9999999),
                'id'=>$record->id,
                'subjects_id'=>$record->subjects_id,
                'subject_name'=>$record->subject->{'name_'.session()->get('lang')}??null,
                'dual'=>false,
                'class_rooms_in_days_id'=>$record->class_rooms_in_days_id,
                'day'=>$record->class_rooms_in_day->day,
                'class_number'=>$record->class_rooms_in_day->class_room->number,
                'classes_id'=>$record->classes_id,
                'class'=>$record->class,
                'teacher'=>$record->teacher,
                'class_room'=>$record->class_rooms_in_day->class_room,
                'className'=>$record->class->{'name_'.session()->get('lang')},
                'teachers_id'=>$teachers_id,
                'teacher_name'=>'<br>'.__('mr',['name'=>$teacher_name]),

            ]);
        }
        $collection = self::setWaitingClass($collection);
        return $collection;
    }
    static function setWaitingClass($collection)
    {
        $collectAllWaiting= collect();
        $teachers= teachers::find($collection->pluck('teachers_id'));
        foreach($teachers as $teacher){
            for($max_waiting_class_rooms= 0;$max_waiting_class_rooms< $teacher->max_waiting_class_rooms;$max_waiting_class_rooms++){
                if($collection->where('teachers_id','!=',$teacher->id)
                              ->whereNotIn('ID_',$collectAllWaiting->pluck('ID_'))
                              ->count()
                ){
                    $randomCollection= $collection->where('teachers_id','!=',$teacher->id)
                                                ->whereNotIn('ID_',$collectAllWaiting->pluck('ID_'))
                                                ->random();
                    $collectAllWaiting->push([
                        'ID_'=>$randomCollection['ID_'],
                        'teachers_id'=>$teacher->id
                    ]);
                }
            }
        }
        $new_collection= collect();
        foreach($collection as $collec){
            $waiting_teachers_id= $collectAllWaiting->firstWhere('ID_',$collec['ID_']);
            $new_collection->push(array_merge($collec,[
                'waiting_teachers_id'=>$waiting_teachers_id['teachers_id']??null
            ]));
        }

        return $new_collection;
    }
}