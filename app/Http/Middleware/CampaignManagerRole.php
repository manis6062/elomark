<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class CampaignManagerRole
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
        if(Gate::allows('campaign_manager')){
            return $next($request);
        }
         return redirect('/dashboard');
     }
}
