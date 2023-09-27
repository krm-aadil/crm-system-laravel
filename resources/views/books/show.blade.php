@extends('layouts.home')
@section('content')
    <div class="container mx-auto px-6">
        <div class="flex">
            <div class="w-1/2">
                <img src="{{ asset('storage/' . $book->CoverImage) }}" alt="{{ $book->title }}" class="w-full h-auto">
            </div>
            <div class="w-1/2 ml-6">
                <h2 class="text-2xl font-semibold">{{ $book->title }}</h2>
                <p class="text-gray-600">Author: {{ $book->author->name }}</p>
                <p class="text-gray-600">Genre: {{ $book->genre->name }}</p>
                <p class="text-gray-600">Language: {{ $book->language->name }}</p>
                <p class="text-gray-600">Price: ${{ $book->price }}</p>
                <p class="text-gray-600">Quantity in Stock: {{ $book->quantity }}</p>
                <p class="text-gray-600">ISBN: {{ $book->ISBN }}</p>
                <p class="text-gray-600">Summary: {{ $book->summary }}</p>

                <!-- Add to Cart Form -->
                <form id="addToCartForm{{ $book->id }}" data-book-id="{{ $book->id }}" action="{{ route('cart.add', ['book' => $book->id]) }}" method="POST">
                    @csrf
                    <button type="button" class="mt-4 px-4 py-2 bg-violet-600 text-white text-sm uppercase font-medium rounded hover:bg-violet-500 focus:outline-none focus:bg-violet-500" onclick="addToCart({{ $book->id }})">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Your JavaScript code for adding to cart can go here -->

@endsection
