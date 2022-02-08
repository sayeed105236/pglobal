<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class VendorMiddleware
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
         if(Auth::user()->usertype == 'vendor' || Auth::user()->usertype == 'admin')
        {
            return $next($request);
           // return redirect('/admin');
        }
        else{
            return redirect('/');
        }
    }
}
