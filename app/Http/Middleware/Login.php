<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Dirape\Token\Token;


class Login
{
    public function handle($request, Closure $next, $guard = null)
    {
//        $response = $next($request);
        $credentials = $request->only('email', 'password');
        if (! Auth::attempt($credentials)) {
            return response(['result' => 'false', 'response' => 'Please check your account or password']);
        }

        $user = $request->user();
        $user->api_token = (new Token())->unique('users','api_token', 32);
        $user->save();
//        echo 'login/////';
        return $next($request);
//        return $response;
    }
}
