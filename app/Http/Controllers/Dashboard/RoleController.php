<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\RoleDataTable;
use App\Http\Requests\Dashboard\CreateAdminRequest;
use App\Http\Requests\Dashboard\CreateRoleRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use App\Models\roles as model;
use Illuminate\Http\Request;

class RoleController extends RoleDataTable
{


    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(RoleDataTable $module)
    {
        $data = [
            'category_name' => 'Users',
            'page_name' => 'roles',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module'),$data) ;
    }

    public function create()
    {
        $data = [
            'category_name' => 'Users',
            'page_name' => 'roles',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view($this->viewPath.'create', $data) ;

    }

    public function store(CreateRoleRequest $request)
    {
        $this->model->create(['name'=>$request->name,'permissions'=>$request->permissions]);
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
        $data = [
            'category_name' => 'Users',
            'page_name' => 'roles',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        $admin = $this->model->find($id);
        return view($this->viewPath.'show', compact('admin'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $role )
    {
        $data = [
            'category_name' => 'Users',
            'page_name' => 'roles',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view($this->viewPath.'edit', compact('role'), $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateRoleRequest $request, model $role)
    {
        $role->update(['name'=>$request->name,'permissions'=>$request->permissions]);
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }
}

