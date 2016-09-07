<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() == null){
            return $next($request);
        }

        if ($request->user()->access_level != 1)
        {
            return redirect('not-authorized');
        }
        Session::put('user_type','admin');
        return $next($request);
    }
}
