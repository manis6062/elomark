<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class AdministratorRole
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
         if(Gate::allows('administrator-access')){
            return $next($request);
        }
         return redirect('/dashboard');

    }
}
