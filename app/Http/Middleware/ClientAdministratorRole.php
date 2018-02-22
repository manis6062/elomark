<?php

namespace App\Http\Middleware;
use Gate;

use Closure;

class ClientAdministratorRole
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
        if(Gate::allows('client_administrator')){
            return $next($request);
        }
         return redirect('/dashboard');
    }
}
