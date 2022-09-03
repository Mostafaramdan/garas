<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdateUpdatesDashboardRequest as Request;
use App\DataTables\UpdatesDashboardDataTable;

use App\Models\updates_dashboard as model ;

class UpdatesDashboardController extends UpdatesDashboardDataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(UpdatesDashboardDataTable $module)
    {
        return request()->ajax() ?
            $module->main() :
            view($this->viewPath . 'index', compact('module'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(Request $request)
    {
        $this->model->create([
            'done_at'=>$request->done_at,
            'title'=>$request->title,
            'url'=>$request->url,
            'type'=>$request->type,
            'image'=>uploadPhoto($request->image,'updates_application')
        ]);

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Teachers $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $updates_dashboard)
    {       
        $record= $updates_dashboard;
        return view($this->viewPath . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $updates_dashboard)
    {
        $record=  $updates_dashboard;
        return view($this->viewPath . 'edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, model $updates_dashboard)
    {
        $updates_dashboard->update([
            'done_at'=>$request->done_at,
            'title'=>$request->title,
            'url'=>$request->url,
            'type'=>$request->type,
            'image'=>uploadPhoto($request->image,'updates_application')
        ]);
            
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    
}

