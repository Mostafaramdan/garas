<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateGradeRequest;
use App\Http\Requests\Dashboard\UpdateGradeRequest;
use App\Models\grades;
use App\Models\classes;
use Illuminate\Http\Request;
use App\DataTables\gradeDataTable;
use App\Models\grades as model;
use App\Models\grade_subject ;
use App\Models\subjects ;

class GradeController extends gradeDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(gradeDataTable $module)
    {
        return request()->ajax() ?
            $module->main() :
            view($this->viewPath . 'index', compact('module'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(CreateGradeRequest $request)
    {
        $grade= $this->model->create([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                'stages_id'=>$request->stages_id,
            ]);

        for($i=0;$i<count($request->subjects_ids);$i++){
            if($request->matrimonial_portions[$i] > 0 || $request->individual_portions[$i]>0)
                grade_subject::create([
                    'grades_id'=>$grade->id,
                    'subjects_id'=>$request->subjects_ids[$i],
                    'matrimonial_portions'=>$request->matrimonial_portions[$i]??0,
                    'individual_portions'=>$request->individual_portions[$i]??0,
                ]);
        }
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix . 'index');
    }

    /**
     * Show the specified resource.
     * @param grade $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(grades $grade)
    {
        return view($this->viewPath . 'show', compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(grades $grade)
    {
        return view($this->viewPath . 'edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateGradeRequest $request, grades $grade)
    {
        $grade->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'stages_id'=>$request->stages_id,
        ]);
        grade_subject::where('grades_id',$grade->id)->delete();
        for($i=0;$i<count($request->subjects_ids);$i++){
            if($request->matrimonial_portions[$i] > 0 || $request->individual_portions[$i]>0)
                grade_subject::create([
                    'grades_id'=>$grade->id,
                    'subjects_id'=>$request->subjects_ids[$i],
                    'matrimonial_portions'=>$request->matrimonial_portions[$i]??0,
                    'individual_portions'=>$request->individual_portions[$i]??0,
                ]);
        }   
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix . 'index');

    }

    public function getGradeInfo($grades_id,$model)
    {
        if($model=='grade_subject'){
            $model = "\App\Models\\".$model;
            return subjects::find($model::where('grades_id',$grades_id)->pluck('subjects_id'));
        }
        $model = "\App\Models\\".$model;
        return $model::where('grades_id',$grades_id)->get();
    }
    
}


