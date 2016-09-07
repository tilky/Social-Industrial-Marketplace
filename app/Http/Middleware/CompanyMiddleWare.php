<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CompanyMiddleWare
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
        
        if($request->user()->access_level == 4)
        {
            Session::put('user_type','company');
            return $next($request);
        }else{
            return redirect('not-authorized');
        }


    }
}
