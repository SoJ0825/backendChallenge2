<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(! $request->user()->is_Admin){
            return response(['result' => 'false', 'response' => 'You are not admin.']);
        }
        return $next($request);
    }
}
