<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    /**
     * Display the specified resource.
     *
     * @param  int $orderId
     * @return \Illuminate\Http\Response
     */
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
       
        $items = $order->products;


        return view('admin.orders.show', [
            'order' => $order,
            'items' => $items,
            'customer' => User::find($order->customer_id),
            'currentStatus' => $order->status,
            'user' => auth()->guard('employee')->user()
        ]);
    }
}
