<?php

namespace App\Http\Controllers\Dashboard\FactoryClassRoomsTables;

use App\Models\school_timetables;

class factoryClassRoom 
{
    // factory method desing pattern
    static function index($id,$request,$type)
    {
        $school_timetable= school_timetables::find($id);
        if($school_timetable->schools_id != AuthLogged()->id){
            abort(401);
        }
        
        switch ($type) {
            case 'all':
                $class = new AllClassRoomsTables($id,$request);
            break;
            case 'generalClassRoom':
                $class = new generalClassRoomTables($id,$request);
            case 'generalClassRoomForAllTeachers':
                $class = new generalClassRoomForAllTeachers($id,$request);
            break;
            case 'filterByTeacher':
                $class = new filterClassRoomByTeacher($id,$request);
                break;
            case 'filterByClass':
                $class = new filterClassRoomByClass($id,$request);
                break;
            case 'FilterByDay':
                $class = new FilterClassRoomsTablesByDay($id,$request);
            break;
            case 'ShowSpecificClassRoomsTables':
                $class = new ShowSpecificClassRoomsTables($id,$request);
            break;
            case 'lastFilterClassRoomsTables':
                $class = new lastFilterClassRoomsTables($id,$request);
            break;
            case 'generalClassRoomForAllClasses':
                $class = new generalClassRoomForAllClasses($id,$request);
            break;
            case 'swapClassRooms':
                $class = new swapClassRooms($id,$request);
            break;
            case 'print_time_table_for_teacher':
                $class = new printTimeTableForTeacher($id,$request);
            break;
            
            default :
                $class = new AllClassRoomsTables($id,$request);
            break;
        }
        return $class->render;
    }
}