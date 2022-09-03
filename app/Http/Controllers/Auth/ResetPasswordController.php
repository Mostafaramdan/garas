<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public static function index()
    {
        return view('pages.ResetPassword.index');
    }

    static function updatePassword(ResetPasswordRequest $request)
    {
        $auth= AuthLogged();
        $auth->password= bcrypt($request->password);
        $auth->save();
        session()->flash('success', __('the_process_completed_successful'));
        return back();
    }
}
