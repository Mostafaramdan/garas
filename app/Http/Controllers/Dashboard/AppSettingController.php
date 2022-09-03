<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AppSettingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateAdvertisementRequest;
use App\Http\Requests\Dashboard\CreateSchoolRequest;
use App\Http\Requests\Dashboard\UpdateAdvertisementRequest;
use App\Http\Requests\Dashboard\UpdateAppSettingRequest;
use App\Http\Requests\Dashboard\UpdateSchoolRequest;
use App\Models\AppSetting;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Advertisement;
use App\Models\Media;
use App\Models\School;
use Illuminate\Http\Request;

class AppSettingController extends AppSettingDataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(AppSettingDataTable $module)
    {
        return  request()->ajax() ?
            $module->main():
            view($this->viewPath.'index', compact('module')) ;
    }

    /**
     * Show the specified resource.
     * @param school $vendor
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */

    public function show(AppSetting $app_setting)
    {
        return view($this->viewPath.'show', compact('app_setting'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(AppSetting $app_setting)
    {
        return view($this->viewPath.'edit', compact('app_setting'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateAppSettingRequest $request, AppSetting $app_setting)
    {
        $app_setting->update($request->validated());
        if (isset($request->image) || $request->hasFile('video'))
            $this->AppSettingMedia($request, $app_setting->id);

        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route($this->routeNamePrefix.'index');

    }

    /**
     * Upload app settings media in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return void
     */
   

    protected function uploadImage($image, $path)
    {
        $imageName = $image->hashName();
        Image::make($image)->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $path . '/' . $imageName));
        return $imageName;
    }

}

