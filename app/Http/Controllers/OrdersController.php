<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Order;
use App\Shop;
use function MongoDB\BSON\toJSON;

class OrdersController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'shop' => 'exists:Shops,name',
                'merchandises' => 'required|array',
                'merchandises.*' => 'required|array',
                'merchandises.*.name' => 'required|exists:Merchandises|string|max:30',
                'merchandises.*.count' => 'required|integer',
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
            str_pad($order_id, 5, "0", 0);
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

    public function read(Request $request, $orderID)
    {
        if (($merchandises = $request->user()->order->where('order_id', '=', $orderID))->count() > 0) {
            $total_price = 0;
            $item_count = 0;
            $data = [];
            foreach ($merchandises as $merchandise) {
                $total_price += $merchandise['count'] * $merchandise['unit_price'];
                $data[$item_count] =
                    [
                        'name' => $merchandise['merchandise'],
                        'count' => $merchandise['count']
                    ];
                $item_count += 1;
            }
            $data['total_price'] = $total_price;
//            $merchandises->put('tatal_price', $total_price);
            return response(['result' => 'true', 'response' => $data]);
        }

        return response(['result' => 'false', 'response' => "Your order doesn't exist"]);
    }

    public function update(Request $request, $orderID)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'merchandises' => 'required|array',
                'merchandises.*' => 'required|array',
                'merchandises.*.name' => 'required|exists:Merchandises|string|max:30',
                'merchandises.*.count' => 'required|integer',
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        if (Order::all()->where('user_id', '=', $request->user()->id)
                ->where('order_id', '=', $orderID)->count() > 0) {

            foreach ($request->merchandises as $item) {
                $order = Order::all()->where('user_id', '=',$request->user()->id)
                    ->where('order_id', '=', $orderID)
                    ->where('merchandise', '=', $item['name'])->first();
                if (is_null($order)) {
                    return response(['result' => 'false', 'response' => 'Some merchandise is not in order']);
                }
            }

            foreach ($request->merchandises as $item) {
                $order = Order::all()->where('user_id', '=', $request->user()->id)
                    ->where('order_id', '=', $orderID)
                    ->where('merchandise', '=', $item['name'])->first();
                $order->merchandise = $item['name'];
                $order->count = $item['count'];
                $order->save();
            };
            return response(['result' => 'true', 'response' => 'OK, We update your order.']);
        }
        return response(['result' => 'false', 'response' => "Your order doesn't exist"]);
    }
}
