<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CreateAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\roles;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use phpDocumentor\Reflection\Types\This;

class AdminController extends AdminDataTable
{


    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(AdminDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }

    public function create()
    {
        $roles= roles::all();
        return view($this->viewPath.'create',compact('roles')) ;
    }

    public function store(CreateAdminRequest $request)
    {
        $this->model->create($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param admins $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $admin = $this->model->find($id);
        return view($this->viewPath.'show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id )
    {
        $roles= roles::all();
        $admin = $this->model->find($id);
        return view($this->viewPath.'edit', compact('admin','roles'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateAdminRequest $request, $id)
    {

        $admins = $this->model->find($id);
        $admins->update($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }

}

