<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\OrderDelivered;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        $searchTerm = request()->query('search');

        $orders = Order::where(function ($query) use ($searchTerm) {
            $query->where('id', 'like', '%' . $searchTerm . '%')
                ->orWhere('customer_name', 'like', '%' . $searchTerm . '%');
        })->orderBy('created_at', 'desc')->paginate(25);

        return view('book_orders.index', compact('orders', 'searchTerm'));
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

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

    public function phonebook(Request $request)
    {
        $searchTerm = $request->input('search');

        // Perform the search query
        $orders = Order::where('customer_name', 'like', '%' . $searchTerm . '%')->paginate(10);

        return view('book_orders.PhoneBook', compact('orders','searchTerm'));
    }

}
