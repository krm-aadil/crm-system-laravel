<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('crm')->except(['welcome']); // Apply the CRM middleware for all methods except 'welcome' and 'subscribe'
    }

    public function index()
    {

        $genres = Genre::all();
        $languages = Language::all();
        $authors=Author::all();

        $books = Book::all();
        return view('books.index', compact('books','genres','languages','authors'));
    }

    public function create()
    {
        $genres = Genre::all();
        $languages = Language::all();
        $authors=Author::all();

        return view('books.create', compact('genres','languages','authors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'ISBN' => 'required|unique:books',
            'price' => 'required|numeric',
            'summary' => 'nullable',
            'CoverImage' => 'nullable',
            'publication_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'quantity' => 'required|numeric',

        ]);

        // Handle file upload if an image is provided
        if ($request->hasFile('CoverImage')) {
            $imagePath = $request->file('CoverImage')->storePublicly('images', 'public');
            $validatedData['CoverImage'] = $imagePath;
        }

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'ISBN' => 'required|unique:books,ISBN,' . $book->id,
            'price' => 'required|numeric',
            'summary' => 'nullable',
            'CoverImage' => 'nullable',
            'publication_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'quantity' => 'required|numeric',

        ]);

        // Handle file upload if an image is provided
        if ($request->hasFile('CoverImage')) {
            $imagePath = $request->file('CoverImage')->storePublicly('images', 'public');
            $validatedData['CoverImage'] = $imagePath;
        }

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function welcome()
    {
        $books = Book::all();
        $userId = Auth::id(); // Get the authenticated user's ID
        $cartItems = Cart::with('book')->where('user_id', $userId)->get();

        return view('welcome',compact('books','cartItems') );
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
