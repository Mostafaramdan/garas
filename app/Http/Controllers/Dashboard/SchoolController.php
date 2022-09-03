<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CreateSchoolRequest;
use App\Http\Requests\Dashboard\UpdateSchoolRequest;
use App\Http\Requests\Dashboard\UpdateSchoolProfileRequest;

use App\Models\schools as  School;
use App\Models\teachers;
use App\Models\subjects;
use App\Models\updates_dashboard;
use App\Models\class_rooms_tables;
use Illuminate\Http\Request;
use App\DataTables\SchoolDataTable;
use App\services\schoolService;
use App\DataTables\classRoomDataTable;
use App\services\classRoomsService;
use App\Traits\Controllers\editProfileSchoolTrait;

class SchoolController extends SchoolDataTable
{

    use editProfileSchoolTrait;
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(SchoolDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }

    public function create()
    {
        return view($this->viewPath.'create');
    }

    public function store(CreateSchoolRequest $request)
    {
        $school= $this->model->create([
            "user_name" => $request->user_name,
            "name" => $request->name,
            "manager" => $request->manager,
            "phone" => $request->phone,
            "phone2" => $request->phone2,
            "country" => $request->country,
            "state" => $request->state,
            "password" =>$request->password,
            "Classrooms_Count" => $request->Classrooms_Count,
            'day_off1'=>$request->holidays[0]??'Friday',
            'day_off2'=>$request->holidays[1]??'Saturday',
            'image'=>createImage($request->image,'schools')
        ]);
        $schoolService = new schoolService($school,$request);
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param school $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $school = $this->model->find($id);
        return view($this->viewPath.'show',compact('school'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $school = $this->model->find($id);

        return view($this->viewPath.'edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateSchoolRequest $request, $id)
    {
        $this->model->where('id',$id)
            ->update([
                'password'=>$request->password,
                'name'=>$request->name,
                'user_name'=>$request->user_name,
                'manager'=>$request->manager,
                'phone'=>$request->phone,
                'phone2'=>$request->phone2,
                'country'=>$request->country,
                'state'=>$request->state,
                'updated_at'=>now(),
                'image'=>createImage($request->image,'schools')
            ]);
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

}
 