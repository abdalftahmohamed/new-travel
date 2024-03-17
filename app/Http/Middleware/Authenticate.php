<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login.client');
//        if (!$request->expectsJson()) {
//            if (\Illuminate\Support\Facades\Request::is( 'admin/dashboard')) {
//                return route('login');
//            }
//            elseif(\Illuminate\Support\Facades\Request::is('/client/dashboard')) {
//                return route('login.client');
//            }
//            else {
//                return route('/');
//            }
//        }

    }
}
