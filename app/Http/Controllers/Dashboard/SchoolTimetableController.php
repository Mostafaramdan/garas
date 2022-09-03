<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SchoolTimetablesDataTable;
use App\Models\school_timetables as model;
use App\Models\class_rooms_tables;
use App\Models\school_timetables;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\FactoryClassRoomsTables\factoryClassRoom;
use Illuminate\Support\Collection;

class SchoolTimetableController extends SchoolTimetablesDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(SchoolTimetablesDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }

    function edit(Request $request, $id)
    {
        // factory desing pattern
        return factoryClassRoom::index($id,$request,$request->type);
    }

    function show(Request $request, $id)
    {
        // factory desing pattern
        return factoryClassRoom::index($id,$request,$request->type);
    }

}
