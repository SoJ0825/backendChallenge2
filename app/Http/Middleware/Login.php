<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
use Dirape\Token\Token;


class Login
{
    public function handle($request, Closure $next, $guard = null)
    {
        $credentials = $request->only('email', 'password');
        if (! Auth::attempt($credentials)) {
            return response(['result' => 'false', 'response' => 'Please login first']);
        }
        $user = $request->user();
        $user->api_token = (new Token())->unique('users','api_token', 32);
        $user->save();
        return $next($request);
    }
}
