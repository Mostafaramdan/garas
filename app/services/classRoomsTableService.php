<?php
namespace App\services;

use App\Models\stages;  
use App\Models\grades;  
use App\Models\classes;
use App\Models\teachers;
use App\Models\teacher_subject;
use App\Models\teacher_classes;
use App\Models\class_rooms_tables;
use Illuminate\Support\Collection;

class classRoomsTableService {

    public $school,$class_room_tables,$classes,$teacher_class,$teachers,$error='';
    private $typeOfClassRoom,$total_class_rooms_in_weak,
    $all_grade_subjects, $class_rooms_in_days;
    function __construct()
    {
        $this->school=AuthLogged();
        $this->class_room_tables=new Collection();
        $this->classes= $this->school->classes->where('is_active',1);
        $this->all_grade_subjects=$this->school->grade_subjects->load('subject');
        $this->class_rooms_in_days=$this->school->class_rooms_in_days->where('is_active',1)->load('class_room');
        $this->total_class_rooms_in_weak= $this->class_rooms_in_days->count();
        $this->teacher_classes=$this->school->teacher_classes;
        $this->teachers=$this->school->teachers;
        $this->create();
    }

    private function create()
    {
        $this->check_class_has_complete_classRooms();
        $this->check_if_each_subject_assigned_to_teacher();
        if($this->error){
            return false;
        }
        foreach($this->classes as $class){
            $grade_subjects= $this->grade_subjects($class->grades_id);
            foreach($this->class_rooms_in_days->sortBy('id') as $class_room){
                if($this->class_room_tables->where('class_rooms_in_days_id',$class_room->id)->where('classes_id',$class->id)->count()>0)
                    continue;                
                if(!$grade_subjects->isEmpty()){
                    $push=true;
                    $count=0;
                    do{
                        ++$count;;
                        $random_grade_subject= $grade_subjects->random();
                        $teachers_id= $this->teacher_classes->where('classes_id',$class->id)->where('subjects_id',$random_grade_subject['subjects_id'])->first()->teachers_id;
                        $teacher = $this->teachers->where('id',$teachers_id)->first();

                        if($count >1000) {
                            $push= true;
                            $this->push_class_room($grade_subjects->first(),$class_room,$class);
                            break;
                        };

                        ############ check the teacher ##########################

                        // check if teacher work in this classroom 
                        $classRoomCustomizeOfTeacher= json_decode($teacher->custom_class_room_in_day,true);
                        if(!in_array($class_room->id,$classRoomCustomizeOfTeacher) )
                            continue;
                        // check if teacher work in this classroom with  another class
                        if($this->class_room_tables->where('teachers_id',$teachers_id)->where('class_rooms_in_days_id',$class_room->id)->first())
                            continue;

                        #################################################
                        if($random_grade_subject['dual']==true){
                            if($class_room->class_room->number==$this->class_rooms_in_days->where('day',$class_room->day)->count()){
                                $push=true;
                            }else{
                                $this->push_class_room($random_grade_subject,$class_room,$class);
                                $next_class_room= $this->class_rooms_in_days->where('day',$class_room->day)->where('class_room.number',$class_room->class_room->number+1)->first();
                                $this->push_class_room($random_grade_subject,$next_class_room,$class);
                                $grade_subjects=$grade_subjects->reject(function($item)use ($random_grade_subject){
                                    return $item['id']==$random_grade_subject['id'];
                                });
                                $push=false;
                            }
                        }else {
                            $this->push_class_room($random_grade_subject,$class_room,$class);
                            $grade_subjects=$grade_subjects->reject(function($item)use ($random_grade_subject){
                                return $item['id']==$random_grade_subject['id'];
                            });
                            $push=false;
                        }
                    }while($push===true);
                }
            }
        }
    }

    private function check_class_has_complete_classRooms()
    {
        $classes= $this->classes;
        $total_class_rooms_in_weak=  $this->total_class_rooms_in_weak;
        $grade_subjects= $this->school->grade_subjects;
        foreach( $classes as $class){   
            $totalClassRoomsSubjectInWeak= $grade_subjects->where('grades_id',$class->grades_id)->sum('individual_portions')+ ($class->grade->grade_subject->sum('matrimonial_portions')*2);

            if( $total_class_rooms_in_weak != $totalClassRoomsSubjectInWeak){
                $this->error = ("الحصص غير منطقية في <br>".
                    $class->{'name_'.session()->get('lang')}.'<br>'.
                    "عدد حصص المواد المضافة في  هذا الفصل  حاليا = {$totalClassRoomsSubjectInWeak}" .'<br>'.
                    "عدد الحصص المدرسية في الاسبوع  = {$total_class_rooms_in_weak}".'<br>'
                );
            }
        }
        return true;
    }

    private function check_if_each_subject_assigned_to_teacher()
    {
        foreach($this->classes as $class){
            $grade= $class->grade;
            $grade_subjects= $grade->grade_subject  ;
            foreach($grade_subjects as $grade_subject){
                
                $subject= $grade_subject->subject;
                $subjects_id= $subject->id;
                $classes_id= $class->id;
                $teacher_class= $this->teacher_classes->where('classes_id',$classes_id)->where('subjects_id',$subjects_id)->first();
                if(!$teacher_class){
                    $this->error = "لم يتم إسناد معلم لمادة ".
                                $subject->{'name_'.session()->get('lang')}.'<br>'.
                                "لفصل ".$class->{'name_'.session()->get('lang')}.'<br>';
                    return false;
                }
            }
            
        }
    }

    private function push_class_room($random_grade_subject,$class_room,$class)
    {
        $teachers_id= $this->teacher_classes->where('classes_id',$class->id)->where('subjects_id',$random_grade_subject['subjects_id'])->first()->teachers_id;
        $teacher_name= $this->teachers->where('id',$teachers_id)->first()->name;
        $record= array_merge($random_grade_subject,[
            'class_rooms_in_days_id'=>$class_room->id,
            'classes_id'=>$class->id,
            'className'=>$class->{'name_'.session()->get('lang')},
            'last_class_room_in_the_day'=>$class_room->class_room->number,
            'class_number_id'=>$class_room->id,
            'day'=>$class_room['day'],
            'class_number'=>$class_room->class_room->number,
            'classes_id'=>$class->id,
            'teachers_id'=>$teachers_id,
            'teacher_name'=>'<br>'.__('mr',['name'=>$teacher_name]),
        ]);
        $this->class_room_tables->push($record);
        return true;
    }

    private function grade_subjects($grades_id)
    {
        $arrange_grade_subjects= new Collection();
        $grade_subjects= $this->all_grade_subjects->where('grades_id',$grades_id);
        foreach ($grade_subjects as $grade_subject){
            for($i=0;$i<$grade_subject->matrimonial_portions;$i++){
                $arrange_grade_subjects->push(array_merge($grade_subject->toArray(),[
                        'id'=>UniqueRandomXDigits(10),
                        'grade_subject_id'=>$grade_subject->id,
                        'subject_name'=>$grade_subject->subject->{'name_'.session()->get('lang')},
                        'subjects_id'=>$grade_subject->subjects_id,
                        'dual'=>true
                    ]));
            }
            for($i=0;$i<$grade_subject->individual_portions;$i++){
                $arrange_grade_subjects->push(array_merge($grade_subject->toArray(),[
                    'id'=>UniqueRandomXDigits(10),
                    'grade_subject_id'=>$grade_subject->id,
                    'subject_name'=>$grade_subject->subject->{'name_'.session()->get('lang')},
                    'subjects_id'=>$grade_subject->subjects_id,
                    'dual'=>false
                ]));
            }
        }
        return $arrange_grade_subjects;
    }
}
