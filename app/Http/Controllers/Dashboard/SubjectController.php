<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CreateSubjectRequest;
use App\Http\Requests\Dashboard\UpdateSubjectRequest;
use App\DataTables\subjectDataTable;
use Illuminate\Http\Request;
use App\Models\subjects as model;

class SubjectController extends subjectDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(subjectDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }

    public function create()
    {
        return view($this->viewPath.'create');
    }

    public function store(CreateSubjectRequest $request)
    {
        $this->model->create($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Subjects $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $subject)
    {
        return view($this->viewPath.'show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $subject)
    {
        return view($this->viewPath.'edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateSubjectRequest $request, model $subject)
    {
        $subject->update($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }
}