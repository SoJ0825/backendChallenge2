<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Merchandise;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $user = $request->user();
        return response(['result' => 'true', 'response' => $user]);
    }


    public function showAllOrder(Request $request)
    {
        $data = Order::all();
        return $data;

    }

    public function clearAllOrder(Request $request)
    {

    }

    public function showAllMerchandise(Request $request)
    {

    }

}
