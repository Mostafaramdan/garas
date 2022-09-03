<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\UpdateClassRoomRequest;
use Illuminate\Http\Request;
use App\DataTables\classRoomDataTable;
use App\Models\class_rooms as model;

class ClassRoomController extends classRoomDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(classRoomDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;

    }

    public function create()
    {
        return view($this->viewPath.'create');
    }

    public function store(UpdateClassRoomRequest $request)
    {
        $class_rooms_records=[];
        for($i=0;$i<count($request->number); $i++){
            model::updateOrCreate(
                [
                    'schools_id'=>AuthLogged()->id,
                    'number'=>$request->number[$i]],
                [
                    'start_at'=>$request->start_at[$i],
                    'end_at'=>$request->end_at[$i],
            ]);
        }
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    
}

