<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdatePackagesRequest as Request;
use App\DataTables\PackagesDashboardDataTable;

use App\Models\packages as model ;

class PackagesController extends PackagesDashboardDataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(PackagesDashboardDataTable $module)
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
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'price'=>$request->price,
            'days'=>$request->days,
            "created_at"=>now()
        ]);

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Teachers $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $package)
    {       
        $record=  $package;
        return view($this->viewPath . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $package)
    {
        $record=  $package;
        return view($this->viewPath . 'edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, model $package)
    {
        $package->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'price'=>$request->price,
            'days'=>$request->days,
            "updated_at"=>now()
        ]);
            
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    
}

