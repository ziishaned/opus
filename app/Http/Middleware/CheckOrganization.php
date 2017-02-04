<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckOrganization
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
        if(!Session::get('organization_set')) {
            return redirect()->route('organizations.set')->with([
                'alert' => 'You need to select organization.',
                'alert_type' => 'danger'
            ]);
        }

        return $next($request);
    }
}
