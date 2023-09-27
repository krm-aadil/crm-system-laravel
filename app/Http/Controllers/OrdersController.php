<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\OrderDelivered;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::all();

        return view('book_orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Update the order status
        $order->update(['status' => $request->status]);

        // Send the order delivered notification email
        if ($request->status === 'delivered') {
            $order->user->notify(new OrderDelivered());
        }

        return response()->json(['message' => 'Status updated successfully']);
    }


}
