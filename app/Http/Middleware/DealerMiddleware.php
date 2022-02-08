<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class DealerMiddleware
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
         if(Auth::user()->usertype == 'dealer' || Auth::user()->usertype == 'admin')
        {
            return $next($request);
        }
        else{
            return redirect('/');
        }
    }
}
