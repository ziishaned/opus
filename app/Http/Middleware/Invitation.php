<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Request;
use App\Models\Invite;

class Invitation
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
        $invitation = Invite::where('code', $request->hash)->where('team_id', $request->team_slug->id)->whereNull('claimed_at')->first();
        
        if (!empty($invitation)) {
            return $next($request);
        }
        
        return abort(404);
    }
}
