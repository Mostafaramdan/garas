<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth ;

class adminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $Auth= AuthLogged();
        if(!$Auth)
            return redirect(route('dashboard.login.index'));

        if(!$Auth->isAdmin())
            return redirect(route('home'));

        return $next($request);
    }
}
