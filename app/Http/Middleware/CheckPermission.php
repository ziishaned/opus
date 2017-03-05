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
    public function handle($request, Closure $next, $permission = null)
    {
        dd($request->user());
        if(Auth::user()) {
            if ($request->user()->can($permission)) {
                return $next($request);
            }
        }
        
        return response()->json([
            'Unauthorized.'
        ], 401);
    }
}
