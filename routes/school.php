<?php 
use  App\Http\Middleware\schoolAuth;

Route::group(['middleware' => schoolAuth::class], function () {

    Route::get('stages&grades&subjects',function(){
        return view('pages.stages&grades&subjects',['page_name'=>'tages&grades&subjects']);
    })->name('stages&grades&subjects');
    
    Route::resources([
        "teachers"=>"TeacherController",
        "stages"=>"StageController",
        "grades"=>"GradeController",
        "subjects"=>"SubjectController",
        "class_rooms_tables"=>"ClassRoomTableController",
        "breaks"=>"BreakController",
        "classes"=>"ClassController",
        "class_rooms"=>"ClassRoomController",
        "school_timetables"=>"SchoolTimetableController",
        "daily_supervisions"=>"DailySupervisionController",
        "exams_table"=>"ExamsTableController",
        "waiting_classrooms"=>"WaitingClassroomsController",
        'contacts'=>'ContactController',
    ]);

    Route::get('class_rooms_tables/create_automatic/create', 'ClassRoomTableController@create_automatic')->name('class_rooms_tables.create_automatic');
    Route::post('class_rooms_tables/create_automatic/create', 'ClassRoomTableController@save_automatic')->name('class_rooms_tables.save_automatic');
    Route::PUT('school_profile','SchoolController@update_school_profile')->name('update_school_profile');
    Route::get('school_profile','SchoolController@school_profile')->name('mySchool');
    Route::get('school_home','SchoolController@school_home')->name('mySchoolHome');
    
    Route::view('days&time','pages.schools.profile.days&time')->name('mySchool.days&time');
    Route::get('teacher/customize/{teacher}','TeacherController@customizeIndex')->name('teacher.customize.index');
    Route::PUT('teacher/customize/{teacher}','TeacherController@updateTeacherCustomize')->name('update.teacher.customize');

    Route::get('teacher/assignment/{teacher}','TeacherController@teacherAssignmentIndex')->name('teacher.assignment.index');
    Route::PUT('teacher/assignment/{teacher}','TeacherController@AssignmentUpdate')->name('update.teacher.assignment');

    Route::get('getGradeInfo/{grades_id}/{model}',"GradeController@getGradeInfo")->name('getGradeInfo');
    
    Route::view('school_profile/edit','pages.schools.profile.edit')->name('school_profile.edit.index');
    Route::PUT('school_profile/edit','SchoolController@editProfile')->name('school_profile.edit');

    Route::get('teachers/custom_class_room/{teacher}/{class_rooms_in_days}','TeacherController@custom_class_room_in_day')->name('teacher.custom_class_room');

    Route::PUT('waiting_classrooms/edit','WaitingClassroomsController@edit_max_waiting_class_rooms')->name('waiting_classrooms.edit_max_waiting_class_rooms');
    Route::post('change_class_rooms','ClassRoomTableController@change_class_rooms')->name('change_class_rooms');
    Route::post('swap_class_rooms','ClassRoomTableController@swap_class_rooms')->name('swap_class_rooms');
    Route::post('swap_class_room_between_two_teacher','ClassRoomTableController@swap_class_room_between_two_teacher')->name('swap_class_room_between_two_teacher');
    
});