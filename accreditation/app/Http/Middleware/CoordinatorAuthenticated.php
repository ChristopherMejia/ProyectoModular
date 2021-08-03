<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CoordinatorAuthenticated
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
        if( Auth::check() )
        {
            // if user manager take him to his dashboard
            if ( Auth::user()->isManager() ) {
                return $next($request);
            }

            // allow user to proceed with request
            else if ( Auth::user()->isTeacher() ) {
                return redirect(route('home'));
            }

            else {
                return $next($request);
            }

        }
    }
}
