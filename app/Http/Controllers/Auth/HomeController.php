<?php 

namespace App\Http\Controllers\Auth;

class HomeController
{
    public  $adminRoute,$schoolRoute;
    public function __construct()
    {
        $this->schoolRoute=route('mySchoolHome');
        $this->adminRoute=route('dashboard.statistics');
    }

    public function redirectAfterLogin()
    {
        $authLogged= AuthLogged();
        if($authLogged){
            $redirect = AuthLogged()->isAdmin()?$this->adminRoute: $this->schoolRoute;
            return redirect($redirect);
        }else{
            return redirect(route('dashboard.login.index'));
        }
    }
}