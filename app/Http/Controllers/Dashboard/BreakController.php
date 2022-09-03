<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CreateBreakRequest;
use App\Http\Requests\Dashboard\UpdateBreakRequest;
use Illuminate\Http\Request;
use App\DataTables\breakTableDataTable;

class BreakController extends breakTableDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(breakTableDataTable $module)
    {
        $data = [
            'category_name' => 'Users',
            'page_name' => 'breaks',
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
            'page_name' => 'breaks',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view($this->viewPath.'create', $data);
        
    }

    public function store(CreateBreakRequest $request)
    {
        $this->model->create($request->all());
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Breaks $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $data = [
            'category_name' => 'Users',
            'page_name' => 'breaks',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        $break = $this->model->find($id);
        return view($this->viewPath.'show', compact('break'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = [
            'category_name' => 'Users',
            'page_name' => 'breaks',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        $break = $this->model->find($id);

        return view($this->viewPath.'edit', compact('break'), $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateBreakRequest $request, $id)
    {
        $breaks = $this->model->find($id);
        $breaks->update($request->except('_token', 'id'));
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }
}

