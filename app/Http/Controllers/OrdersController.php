<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Order;
use App\Shop;
use App\Merchandise;

class OrdersController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'shop' => 'exists:Shops,name',
                'merchandises' => 'array',
                'merchandises.*' => 'array',
                'merchandises.*.name' => 'exists:Merchandises|string|max:30',
                'merchandises.*.count' => 'integer',
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        $user_id = $request->user()->id;
        $order_id = 1;

        //must have first(), or $merchandise will be a [object], not just a object
        $merchandises = Shop::all()->where('name', '=', $request->shop)->first()->merchandise;

        if ($request->user()->order->count() > 0) {
            $order = $order_id = $request->user()->order;
            $order_id = $order->where('user_id', '=', $user_id)->last()->order_id + 1;
            str_pad($order_id,5,"0", 0);
        }

        foreach ($request->merchandises as $item) {
            $merchandise = $merchandises->where('name', '=', $item['name'])->first();
            Order::create([
                'order_id' => $order_id,
                'user_id' => $user_id,
                'merchandise' => $item['name'],
                'count' => $item['count'],
                'unit_price' => $merchandise['price'],
            ]);
        }
        return response(['result' => 'true', 'response' => 'We get your order.']);
    }
}
