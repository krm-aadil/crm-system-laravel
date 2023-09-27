<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        // Validate the checkout form input (customer details and payment)
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Create an order for each item in the cart
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $orderTotal = 0; // Initialize the total amount

        foreach ($cartItems as $cartItem) {
            // Calculate the total amount for the current book item
            $book = $cartItem->book;
            $totalAmountForItem = $book->price * $cartItem->quantity;

            // Add the current item's total amount to the overall order total
            $orderTotal += $totalAmountForItem;

            Order::create([
                'user_id' => $user->id,
                'book_id' => $cartItem->book_id,
                'quantity' => $cartItem->quantity,
                'customer_name' => $request->input('customer_name'),
                'customer_email' => $request->input('customer_email'),
                'customer_address' => $request->input('customer_address'),
                'customer_phone' => $request->input('customer_phone'),
                'payment_method' => $request->input('payment_method'),
                'total_amount' => $totalAmountForItem, // Store the total amount for the current item
            ]);

            // Ensure that there is a stock record for the book
            if ($book->stock) {
                // Update the stock quantity of the book
                $book->stock->decrement('quantity', $cartItem->quantity);
            }

            // Remove the cart item
            $cartItem->delete();
        }

        // Now, $orderTotal contains the overall total amount for the order



        return redirect()->route('user.dashboard')->with('success', 'Checkout successful.');
    }

    // Add methods for viewing and managing orders as needed
}
