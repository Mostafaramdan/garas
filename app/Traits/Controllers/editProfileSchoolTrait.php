<?php
namespace App\Traits\Controllers;

use App\Models\stages;  
use App\Models\grades;  
use App\Models\classes;
use App\Models\teacher_subject;
use App\Models\class_rooms_tables;
use Illuminate\Support\Collection;
use App\Models\schools as  School;
use App\Models\teachers;
use App\Models\subjects;
use App\Models\updates_dashboard;
use App\DataTables\classRoomDataTable;
use App\Http\Requests\Dashboard\UpdateSchoolRequest;
use App\Http\Requests\Dashboard\UpdateSchoolProfileRequest;
use App\services\classRoomsService;

trait editProfileSchoolTrait {

    public function update_school_profile(UpdateSchoolProfileRequest $request)
    {
        $school= AuthLogged();
        School::where('id',$school->id)->update([
            'password'=>bcrypt($request->password),
            'Classrooms_Count'=>$request->Classrooms_Count,
            'time_of_classroom'=>$request->time_of_classroom,
            'start_day'=>$request->start_day,
            'day_off1'=>$request->holidays[0]??null,
            'day_off2'=>$request->holidays[1]??null,
        ]);
        (new classRoomsService($school))->update_classRooms();
        
        session()->flash('success', __('the_process_completed_successful'));
        return back();
    }
    public function school_profile(classRoomDataTable $module)
    {   
        return view('pages.schools.profile.school_info');
    }

    public function school_home()
    {
        $school= Authlogged();
        $total_teachers= teachers::where('schools_id',$school->id)->count();
        $classId = $school->classes->first()->id??null;
        $total_class_room_tables= $school->school_timetables->count() ;
        $total_classes= $school->classes->count();
        $updates_dashboard= updates_dashboard::where('type','dashboard')->get();
        return view('pages.schools.profile.school_home',compact('updates_dashboard','total_classes','total_teachers','total_class_room_tables'));

    }

    public function editProfileIndex()
    {
        return view('pages.schools.profile.edit');
    }

    public function editProfile( UpdateSchoolRequest $request )
    {
        $school= AuthLogged();
        
        School::where('id',$school->id)->update([
            'name'=>$request->name,
            'user_name'=>$request->user_name,
            'manager'=>$request->manager,
            "education_administration"=>$request->education_administration,
            'phone'=>$request->phone,
            'phone2'=>$request->phone2,
            'password'=>bcrypt($request->password),
            'country'=>$request->country,
            'State'=>$request->State,
            'image'=>self::uploadPhoto($request->image, 'schools', $school)
        ]);
        return redirect(route('home'));
    }
    public static function uploadPhoto($image,$folderName,$school)
    {
        if(!$image)return $school->image;
        return uploadPhoto($image,$folderName);
    }

}