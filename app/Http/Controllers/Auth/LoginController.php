<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admins;
use App\Models\schools;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    


    public function index()
    {
        if(AuthLogged())
            return redirect(route('home'));
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
            return self::schoolAuth()??self::adminAuth()?? back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle an login request in case of admin.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    static function adminAuth()
    {
        if (Auth::attempt(['email'=>request()->username,'password'=>request()->password])) {
            return redirect(route('dashboard.statistics'));
        }
    }

    /**
     * Handle an login request in case of school.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    static function schoolAuth()
    {
        if (Auth::guard('school')->attempt(['user_name'=>request()->username,'password'=>request()->password])) {
            if(AuthLogged()->is_active && AuthLogged()->nextSubscribtionAt >= date('Y-m-d'))
                return redirect(route('home'));
            else {
                Auth::guard('school')->logout(AuthLogged());
                return redirect(route('dashboard.login.index'))->with('error',__("can't login to this school"));
            }
        }
    }

    static function logout()
    {
        $model = AuthLogged();
        $model->getTable()=='admins'? Auth::logout():Auth::guard('school')->logout();
        return redirect(route('home'));
    }
}
