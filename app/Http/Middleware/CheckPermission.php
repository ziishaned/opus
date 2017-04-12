<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions = null)
    {
        if (Auth::user()) {
            if ($request->user()->hasPermission($permissions)) {
                return $next($request);
            }
        }
        
        abort(403);
    }
}
