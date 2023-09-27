<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, Book $book)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Return a JSON response for unauthenticated users
            return response()->json(['success' => false, 'message' => 'User is not authenticated'], 401);
        }

        $user = Auth::user();

        // Check if the book is already in the user's cart
        $existingCartItem = $user->carts->where('book_id', $book->id)->first();

        if ($existingCartItem) {
            // If the book is already in the cart, increment its quantity
            $existingCartItem->quantity++;
            $existingCartItem->save();
        } else {
            // If the book is not in the cart, create a new cart item
            $cartItem = new Cart([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'quantity' => 1,
            ]);

            $cartItem->save();
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            // If the book is already in the session cart, increment its quantity
            $cart[$book->id]['quantity']++;
        } else {
            // If the book is not in the session cart, add it
            $cart[$book->id] = [
                'book_id' => $book->id,
                'quantity' => 1,
            ];
        }

        // Store the updated cart back in the session
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Book added to cart successfully']);
    }


    public function viewCart()
    {
        // Retrieve the user's cart items
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        return view('dashboard', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        // Update the cart items' quantities based on the form input
        $user = Auth::user();
        $data = $request->validate([
            'quantity.*' => 'required|numeric|min:1',
        ]);

        foreach ($data['quantity'] as $cartItemId => $quantity) {
            $cartItem = Cart::findOrFail($cartItemId);
            $cartItem->update(['quantity' => $quantity]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart(Book $book)
    {
        // Remove an item from the cart
        $user = Auth::user();
        $cartItem = Cart::where('user_id', $user->id)->where('book_id', $book->id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

}
