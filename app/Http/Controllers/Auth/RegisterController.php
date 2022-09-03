<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\CreateSchoolRequest;
use App\Models\schools ;

use App\services\schoolService;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function register(CreateSchoolRequest $request)
    {
        $school= schools::create([
            "user_name" => $request->user_name,
            "name" => $request->name,
            "manager" => $request->manager,
            "phone" => $request->phone,
            "phone2" => $request->phone2,
            "country" => $request->country,
            "state" => $request->state,
            "password" => $request->password,
            "Classrooms_Count" => "6",
            'day_off1'=>$request->holidays[0]??'Friday',
            'day_off2'=>$request->holidays[1]??'Saturday',
            'image'=>createImage($request->image,'schools')
        ]);
        Auth::guard('school')->login($school);
        $schoolService = new schoolService($school,$request);
        session()->flash('success', __('the_process_completed_successful'));
        return redirect()->route('home');
    }

  
}
