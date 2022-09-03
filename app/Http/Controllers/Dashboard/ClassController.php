<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdateClassRequest;
use Illuminate\Http\Request;
use App\DataTables\classDataTable;
use App\Models\classes as model;
use App\Models\grades;

class ClassController extends classDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(classDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }
    public function create()
    {
        return view($this->viewPath.'create');
    }

    public function store(CreateUpdateClassRequest $request)
    {
        foreach($request->grades_ids as $grades_id){  
            if($this->checkUniqueClass($grades_id)){
                $grade= grades::find($grades_id) ;
                return back()->with('error', __("the class exists in",['class'=>request()->name_ar,'grade'=>$grade->{'name_'.session()->get('lang')}.' '.$grade->stage->{'name_'.session()->get('lang')} ]));         
            }
            $this->model->create([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                'grades_id'=>$grades_id
            ]);
        }
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }


    public  function checkUniqueClass($grade_id)
    {

        if( $this->model->where('name_ar',request()->name_ar)->where('grades_id',$grade_id)->count() > 0 || 
            $this->model->where('name_en',request()->name_en)->where('grades_id',$grade_id)->count() > 0
            ){
            return true;
        }

    }
    /**
     * Show the specified resource.
     * @param grade $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $class)
    {
        return view($this->viewPath.'show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $class)
    {
        return view($this->viewPath.'edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update( model $class, CreateUpdateClassRequest $request,)
    {
        $class->update($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }
}

