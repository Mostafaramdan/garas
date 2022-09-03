<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateTeacherRequest;
use App\Http\Requests\Dashboard\UpdateTeacherRequest;
use App\Http\Requests\Dashboard\UpdateTeacherClassRoomRequest;
use App\DataTables\AdabterTeacherDataTable;

use App\Models\teachers as model ;
use App\Models\teacher_subject;
use App\Models\classes;
use App\Models\teacher_classes;
use Illuminate\Http\Request;

class WaitingClassroomsController extends AdabterTeacherDataTable
{
    /**
     * Display a listing of the resource.
     * @return
     */
    public function index( AdabterTeacherDataTable $module)
    {
        return request()->ajax() ?
            $module->main() :
            view($this->viewPath . 'index', compact('module'));
    }
 
 
    public function update(Request $request)
    {
        if(count($request->max_waiting_class_rooms??[])){
            for($i=0;$i<count($request->max_waiting_class_rooms); $i++){
                model::find($request->teachers_id[$i])->update([
                    'max_waiting_class_rooms'=>$request->max_waiting_class_rooms[$i]
                ]);
            }
            session()->flash('success', __('the_process_completed_successful'));
        }else{
            session()->flash('error', __('he'));
        }
        return redirect()->route($this->routeNamePrefix.'index');
    }

}
