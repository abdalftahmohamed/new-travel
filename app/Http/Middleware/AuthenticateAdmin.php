<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('web')->check())
        {
            if(Auth::guard('web')->user()->role == 'admin')
            {
                return $next($request);
            }
            else
            {
                Auth::guard('web')->logout();
                return response([
                    'status' => 'False',
                    'status_code'=>403,
                    'en'=>'Access Denied! as you are not as admin',
                    'ar'=>'انت لست الأدمن حاول مره أخري',
                ]);
            }
        }
        else
        {
            return response('Unauthorized', 401);
        }

    }
}
