<?php

namespace App\Http\Middleware;

use Closure;

class TeamMode
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
        if (env('ONE_TEAM_MODE') == true) {
            abort(403);
        }
    }
}
