<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;

use App\Observers\studentObserver;
use App\Models\students;

use App\Observers\teacherObserver;
use App\Models\teachers;

use App\Observers\classRoomTableObserver;
use App\Models\class_rooms_tables;

use App\Observers\classObserver;
use App\Models\classes;

use App\Observers\adminObserver;
use App\Models\admins;

use App\Observers\stageObserver;
use App\Models\stages;

use App\Observers\gradeObserver;
use App\Models\grades;

use App\Observers\classRoomObserver;
use App\Models\class_rooms;

use App\Observers\subjectObserver;
use App\Models\subjects;

use App\Observers\daily_supervisionsObserver;
use App\Models\daily_supervisions;

use App\Observers\exams_tableObserver;
use App\Models\exams_table;

use App\Models\school_timetables;
use App\Observers\schollTimeTableObserver;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('*', function($view){           
            // $view->with('AuthLogged', AuthLogged());
        });

    }

    /**
     * Bootstrap any application services.  
     *
     * @return void
     */
    public function boot()
    {
        teachers::observe(teacherObserver::class);
        students::observe(studentObserver::class);
        class_rooms_tables::observe(classRoomTableObserver::class);
        classes::observe(classObserver::class);
        admins::observe(adminObserver::class);
        stages::observe(stageObserver::class);
        grades::observe(gradeObserver::class);
        class_rooms::observe(classRoomObserver::class);
        subjects::observe(subjectObserver::class);
        daily_supervisions::observe(daily_supervisionsObserver::class);
        exams_table::observe(exams_tableObserver::class);
        school_timetables::observe(schollTimeTableObserver::class);
        
    }
}
