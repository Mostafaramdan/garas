<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SchoolDataTable;
use App\Models\subscriptions;
use App\Models\schools;
use App\Models\students;
use App\Models\teachers;
use App\Models\admins;
use DB;

class StatisticsController 
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(SchoolDataTable $module)
    {
        $subscriptions = subscriptions::selectRaw('SUM(price) as total_income ,count(*) as total_subscriptions')->first();
        $subscriptions_statistics = subscriptions::select(
                                    DB::raw('packages_id'),
                                    DB::raw("(count(packages_id )) as `average`")
                                )->with('package')
                                ->groupBy('packages_id')
                                ->get();
        $schools = schools::selectRaw('id,name,phone')->without(['stages','class_rooms_in_days','grade_subjects','subjects'])->get();
        $total_students = students::count();
        $total_teachers = teachers::count();
        $total_admins = admins::count('id');
        return  view('pages.statistics.index',compact('module','subscriptions_statistics','total_admins','subscriptions','schools','total_students','total_teachers')) ;
    }
}