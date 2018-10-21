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


    public function showAllOrders()
    {
        $data = Order::all();

        return response(['reslut' => 'true', 'response' => $data]);

    }

    public function clearAllOrders()
    {
        Order::truncate();
        return response(['result' => 'true', 'response' => 'Destroy all orders']);
    }

    public function showAllMerchandises()
    {
        $data = Merchandise::all();
        return response(['result' => 'true', 'response' => $data]);
    }

}
