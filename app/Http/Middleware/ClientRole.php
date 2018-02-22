<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class ClientRole
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
        if(Gate::allows('client')){
            return $next($request);
        }
         return redirect('/dashboard');
    }
}
