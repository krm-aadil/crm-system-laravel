<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
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
        $DramaBooks = Book::where('genre_id', 2)->get();
        $ComedyBooks = Book::where('genre_id', 3)->get();
        $RomanceBooks = Book::where('genre_id', 4)->get();
        $HorrorBooks = Book::where('genre_id', 5)->get();
        $MysteryBooks = Book::where('genre_id', 6)->get();
        $ThrillerBooks = Book::where('genre_id', 7)->get();
        $CrimeBooks = Book::where('genre_id', 8)->get();
        $ScienceFictionBooks = Book::where('genre_id', 9)->get();


        return view('categories', compact('ActionBooks',
            'cartItems','books','searchTerm','DramaBooks','ComedyBooks',
            'RomanceBooks','HorrorBooks','MysteryBooks','ThrillerBooks','CrimeBooks',
            'ScienceFictionBooks'));
    }

    public function layout()
    {
        $userProfilePic= User::select('profile_photo_path')->where('id', auth()->user()->id)->first();

        return view('layouts.admin',compact('userProfilePic'));
    }

}
