<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        #https://www.youtube.com/watch?v=_5O4hWpxR6M
        #api
        if ($request->hasHeader('Accept-Language')){
            App::setLocale($request->header('Accept-Language'));
        }


        #web
        if (Session::has('lang')){
            App::setLocale(Session::get('lang'));
        }

//        $locale = $request->lang ? $request->lang :'en';
//        app()->setLocale($request->hasHeader('Accept-Language'));
        return $next($request);
    }
}
