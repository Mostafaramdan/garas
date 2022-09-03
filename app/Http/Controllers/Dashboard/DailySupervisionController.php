<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdateDailySupervisionRequest as Request;
use App\DataTables\DailySupervisionDataTable as DataTable;

use App\Models\daily_supervisions as model;

class DailySupervisionController extends DataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(DataTable $module)
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
        $this->model->create($request->validated());

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Teachers $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $daily_supervision)
    {       
        $record=  $daily_supervision;
        return view($this->viewPath . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $daily_supervision)
    {
        $record=  $daily_supervision;
        return view($this->viewPath . 'edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, model $daily_supervision)
    {
        $daily_supervision->update($request->validated());

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    
}

