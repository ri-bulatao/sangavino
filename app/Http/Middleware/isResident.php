<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isResident
{
   
    public function handle(Request $request, Closure $next)
    {
        if(!$request->user()->hasRole('resident'))
        {
            abort(404);
        }

        return $next($request);
    }
}
