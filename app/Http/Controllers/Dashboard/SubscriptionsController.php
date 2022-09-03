<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdateSubscriptionsRequest as Request;
use App\DataTables\SubscriptionsDataTable;

use App\Models\subscriptions as model ;
use App\Models\schools  ;
use App\Models\packages;

class SubscriptionsController extends SubscriptionsDataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(SubscriptionsDataTable $module)
    {
        return request()->ajax() ?
            $module->main() :
            view($this->viewPath . 'index', compact('module'));
    }

    public function create()
    {
        $schools = schools::active()->select(['name','id'])
            ->without(['stages','class_rooms_in_days','grade_subjects','subjects'])
            ->get();
        $packages = packages::all();

        return view($this->viewPath . 'create',compact('schools','packages'));
    }

    public function store(Request $request)
    {
        $package= packages::find($request->packages_id);
        $this->model->create([
            'packages_id'=>$request->packages_id,
            'schools_id'=>$request->schools_id,
            'subscribed_at'=>now(),
            'end_at'=>date('Y-m-d', strtotime(now(). " + {$package->days} days"))
        ]);

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    /**
     * Show the specified resource.
     * @param Teachers $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(model $subscription)
    {       
        $record= $subscription;
        return view($this->viewPath . 'show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(model $subscription)
    {
        $schools = schools::active()->select(['name','id'])
        ->without(['stages','class_rooms_in_days','grade_subjects','subjects'])
        ->get();
        $packages = packages::all();

        $record=  $subscription;
        return view($this->viewPath . 'edit', compact('record','schools','packages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, model $subscription)
    {
        $subscription->update([
            'packages_id'=>$request->packages_id,
            'schools_id'=>$request->schools_id,
            // 'subscribed_at'=>now(),
            'end_at'=>date('Y-m-d', strtotime(now(). " + {$package->days} days"))

        ]);
            
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');
    }

    
}

