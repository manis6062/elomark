<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class AdminCampaignClientadmin
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
        if(Gate::allows('admin-campaign-clientadmin-access')){
            return $next($request);
        }
         return redirect('/dashboard');
    }
}
