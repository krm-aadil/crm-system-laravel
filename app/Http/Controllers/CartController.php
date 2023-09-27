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
        $existingCartItem = Cart::where('user_id', $user->id)->where('book_id', $book->id)->first();

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

        return response()->json(['success' => true, 'message' => 'Book added to cart successfully']);
    }

    public function viewCart()
    {
        // Retrieve the user's cart items
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        return view('dashboard', compact('cartItems'));
    }

    public function updateCartItem(Request $request, $cartItemId)
    {
        $user = Auth::user();
        $cartItem = Cart::find($cartItemId);

        if (!$cartItem || $cartItem->user_id !== $user->id) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update the cart item's quantity
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        // You can also recalculate the total cart amount here if needed

        return response()->json(['message' => 'Cart item updated successfully']);
    }

    public function removeCartItem(Request $request, $cartItemId)
    {
        $user = Auth::user();
        $cartItem = Cart::find($cartItemId);

        if (!$cartItem || $cartItem->user_id !== $user->id) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        // Remove the cart item
        $cartItem->delete();

        // You can also recalculate the total cart amount here if needed

        return response()->json(['message' => 'Cart item removed successfully']);
    }


    public function getCartCount()
    {
        $cartCount = Cart::where('user_id', auth()->id())->count();

        return response()->json(['cartCount' => $cartCount]);
    }
}
