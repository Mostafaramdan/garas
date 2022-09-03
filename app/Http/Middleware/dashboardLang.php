<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cookie;
use Config;

class dashboardLang
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
        $lang= $request->lang??
                    Cookie::get('lang')??
                     $request->session()->get('lang')
                    ??'ar';
        // dd($lang);
        session()->put('lang', $lang);
        Config::set('app.locale',$lang);
        Cookie::queue('lang', $lang);
        return $next($request);
    }
}
