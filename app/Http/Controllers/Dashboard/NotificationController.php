<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CreateNotificationRequest;
use App\Http\Requests\Dashboard\UpdateNotificationRequest;
use App\Models\notifications;
use App\Models\teachers;
use App\Models\students;
use Illuminate\Http\Request;
use App\DataTables\notificationDataTable;
use App\Notifications\notificationController as Notification;

class NotificationController extends notificationDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(notificationDataTable $module)
    {
        return request()->ajax() ?
            $module->main() :
            view($this->viewPath . 'index', compact('module'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(CreateNotificationRequest $request ,notifications $notification)
    {
        $Alltargets=[];
        if(AuthLogged()->isSchool()){
            if($request->type == 'schoolToTeacher'){
                $Alltargets[]= teachers::where('schools_id',AuthLogged()->id)->get();
            }
            if($request->type == 'schoolToClass'){
                $Alltargets[]= students::school()->get();
            }

        }else{
            if($request->type == 'adminToteachers'){
                $Alltargets[]= teachers::where('schools_id',AuthLogged()->id)->get();
            }
            else{
                $Alltargets[]= students::all();
                $Alltargets[]= teachers::all    ();
            }
        }
        foreach($Alltargets as $targets){
            new Notification($targets,['content'=>$request->content],['type'=>$request->type]);
        }
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix . 'index');
    }

    /**
     * Show the specified resource.
     * @param school $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(notifications $notification)
    {
       
        return view($this->viewPath . 'show', compact('notification'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(notifications $notification)
    {
        return view($this->viewPath . 'edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateNotificationRequest $request, notifications $notification)
    {
        $notification->update($request->except('_token', 'id'));
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix . 'index');

    }

    public function destroy(notifications $notification)
    {
        $notification->delete();
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix . 'index');

    }
}

