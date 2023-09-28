<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePagesController extends Controller
{
    public function search(Request $request)
    {

        $searchTerm = request()->query('search');

        $books = Book::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('ISBN', 'like', '%' . $searchTerm . '%');
        })->orderBy('created_at', 'desc')->paginate(15);

        $userId = Auth::id(); // Get the authenticated user's ID
        $cartItems = Cart::with('book')->where('user_id', $userId)->get();

        return view('books.search', compact( 'cartItems','books','searchTerm'));
    }


    public function about()
    {

        return view('AboutUs');
    }


    public function categories()
    {
        $searchTerm = request()->query('search');

        $books = Book::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('ISBN', 'like', '%' . $searchTerm . '%');
        })->orderBy('created_at', 'desc')->paginate(15);

        $userId = Auth::id(); // Get the authenticated user's ID
        $cartItems = Cart::with('book')->where('user_id', $userId)->get();

        $ActionBooks = Book::where('genre_id', 1)->get();


        return view('categories', compact('ActionBooks','cartItems','books','searchTerm'));
    }

}
