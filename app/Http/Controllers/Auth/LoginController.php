<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        return 'in LoginController';
//        $user = Auth::user();
//        $user->api_token = 'kkk';
//        $user->save();
    }
}