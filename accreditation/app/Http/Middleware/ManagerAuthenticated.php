<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ManagerAuthenticated
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
        if(Auth::user()->isCoordinator()){
            return redirect(route('home'));
        }
        else if ( Auth::user()->isManager() ) {
            return $next($request);
       }

       return redirect(route('home'));
        
    }
}
