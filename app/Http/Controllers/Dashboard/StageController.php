<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateStageRequest;
use App\Http\Requests\Dashboard\UpdateStageRequest;
use Illuminate\Http\Request;
use App\DataTables\stagesDataTable;
use App\Models\stages as model;

class StageController extends stagesDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(stagesDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }
    public function create()
    {
        return view($this->viewPath.'create');
    }

    public function store(CreateStageRequest $request)
    {
        $this->model->create($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Stage $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $stage = $this->model->find($id);
        return view($this->viewPath.'show', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $stage)
    {
        return view($this->viewPath.'edit', compact('stage'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateStageRequest $request, $id)
    {
        $Stages = $this->model->find($id);
        $Stages->update($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }
}

