<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $role =Auth::user()->role;

        if ($role == 'admin') {
            return redirect()->route('analytics');
        } elseif ($role == 'crm') {
            return redirect()->route('crm.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function user_dashboard()
    {
        $user = Auth::user();

        // Fetch the user's purchase history from the Order model
        $purchaseHistory = Order::where('user_id', $user->id)->get()
            ->sortByDesc('created_at')->take(15);

        // Fetch the cart items (if needed)
        $cartItems = Cart::where('user_id', $user->id)->get();

        return view('user.dashboard', compact('purchaseHistory', 'cartItems'));
    }
}
