<?php

namespace App\Http\Middleware;

use Closure;

class SupplierMiddleWare
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

        if ($request->user()->access_level == 2 || $request->user()->access_level == 3)
        {
            return $next($request);
        }else{
            return redirect('not-authorized');
        }
    }
}
