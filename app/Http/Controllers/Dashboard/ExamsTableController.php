<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdateExamsTableRequest as Request;
use App\DataTables\ExamsTableDataTable as DataTable;

use App\Models\exams_table as model;

class ExamsTableController extends DataTable
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

    public function show(model $exams_table)
    {       
        $record=  $exams_table;
        return view($this->viewPath . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $exams_table)
    {
        $record=  $exams_table;
        return view($this->viewPath . 'edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, model $exams_table)
    {
        $exams_table->update($request->validated());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    
}

