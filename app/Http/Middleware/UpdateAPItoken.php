<?php

namespace App\Http\Middleware;

use Closure;
use Dirape\Token\Token;

class UpdateAPItoken
{

    public function handle($request, Closure $next)
    {
//        $response = $next($request);

        $user = $request->user();
        $user->api_token = (new Token())->unique('users','api_token', 32);
        $user->save();

        return $next($request);
//        return $response;
    }
}
