<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $user = $request->user();
        return response(['result' => 'true', 'response' => $user]);
    }


}
