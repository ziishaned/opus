<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;
use App\Models\Timezone;

class DashboardMiddleware
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
        if(Auth::user()) {
            if(!Session::get('user_timezone')) {
                Session::put('user_timezone', Auth::user()->timezone);
            }
        }
        return $next($request);
    }
}
