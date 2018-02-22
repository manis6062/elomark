<?php

namespace App\Http\Middleware;
use Gate;
use Closure;

class SalesDeveloperRole
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
        if(Gate::allows('sales_developer')){
            return $next($request);
        }
         return redirect('/dashboard');
    }
}
