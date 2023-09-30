@extends('layouts.home')
@section('content')

    <div x-data="{ cartOpen: false }">
        <!-- Cart button -->
        <div class="px-4 py-2 absolute right-0 top-0">
            <button @click="cartOpen = !cartOpen" class="btn btm-outline-dark px">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Cart <span class="badge badge-pill badge-dark" id="cart-count">0</span>
            </button>
        </div>



        <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 shadow-2xl transform overflow-y-auto bg-white border-l-2 border-blue-400 rounded-2xl">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
                <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <hr class="my-3">
            <div class="flex flex-col mt-6">
                @php
                    $totalAmount = 0; // Initialize the total amount
                @endphp

                @forelse ($cartItems as $cartItem)
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex">
                            <img class="h-20 w-20 object-cover rounded" src="{{ asset('storage/' . $cartItem->book->CoverImage) }}" alt="{{ $cartItem->book->title }}">
                            <div class="mx-3">
                                <h3 class="text-sm text-gray-600">{{ $cartItem->book->title }}</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-gray-700 ">Quantity : {{ $cartItem->quantity }}</span>
                                </div>
                                <div>
                                    <!-- Calculate and display the item subtotal -->
                                    <span class="text-gray-600">${{ $cartItem->book->price * $cartItem->quantity }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        // Add the item subtotal to the total amount
                        $totalAmount += $cartItem->book->price * $cartItem->quantity;
                    @endphp

                @empty
                    <p class="text-gray-600">Your cart is empty.</p>
                @endforelse


            </div>
            <div class="mt-8">
                <div>
                    <!-- Display the total amount -->
                    <p class="text-lg text-gray-800 font-medium">Total: ${{ $totalAmount }}</p>
                </div>
                <form class="flex items-center justify-center">
                    <a href="{{route('user.dashboard')}}" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span>Go to Cart <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </form>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-blue-100 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="container">
        <div class="container mx-auto px-6 mt-8">
            <div class="flex">
                <div class="w-1/2">
                    <img src="{{ asset('storage/' . $book->CoverImage) }}" alt="{{ $book->title }}" class="w-full h-auto rounded-lg shadow-lg">
                    <br>
                </div>
                <div class="w-1/2 ml-6">
                    <h2 class="text-3xl font-semibold mb-2">{{ $book->title }}</h2>
                    <p class="text-black font-semibold">Author: {{ $book->author->first_name }} {{ $book->author->last_name }}</p>
                    <p class="text-black font-semibold">Genre: {{ $book->genre->genre_name }}</p>
                    <p class="text-black font-semibold">Language: {{ $book->language->language_name }}</p>
                    <p class="text-black font-semibold">Price: ${{ $book->price }}</p>
                    <p class="text-black font-semibold">Quantity in Stock: {{ $book->quantity }}</p>
                    <p class="text-black font-semibold">ISBN: {{ $book->ISBN }}</p>
                    <p class="text-black font-semibold mt-4">Summary:</p>
                    <p class="text-gray-800">{{ $book->summary }}</p>

                    <!-- Add to Cart Form -->
                    <form id="addToCartForm{{ $book->id }}" data-book-id="{{ $book->id }}" action="{{ route('cart.add', ['book' => $book->id]) }}" method="POST">
                        <br>
                        @csrf
                        <button type="button" class="btn btn-primary px-5" onclick="addToCart({{ $book->id }})">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
                    </div>
                </div>

            </div>
        </div>
        <script>
            function updateCartCount() {
                // Send an AJAX request to get the cart count from the database
                $.ajax({
                    type: 'GET',
                    url: "{{ route('cart.count') }}",
                    success: function(response) {
                        // Update the cart count in the view
                        const cartCount = response.cartCount;
                        const cartCountBadge = document.getElementById('cart-count');
                        if (cartCountBadge) {
                            cartCountBadge.textContent = cartCount;
                        }
                    },
                    error: function() {
                        // Handle any errors that may occur during the AJAX request
                        console.error('Error fetching cart count.');
                    }
                });
            }

            // Call the updateCartCount function when the page loads
            updateCartCount();

            function addToCart(bookId) {
                // Prevent the default form submission
                event.preventDefault();

                // Check if the user is authenticated
                @auth
                // Get the form element
                const form = document.getElementById(`addToCartForm${bookId}`);

                // Send an AJAX request to add the book to the cart
                $.ajax({
                    type: 'POST',
                    url: form.action,
                    data: {
                        _token: form.querySelector('input[name="_token"]').value
                    },
                    success: function(response) {
                        if (response.success) {
                            // Display a success pop-up
                            Swal.fire({
                                icon: 'success',
                                title: 'Book Added to Cart',
                                text: 'The book has been added to your cart successfully.',
                            }).then((result) => {
                                // Reload the page when the alert is closed
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                            // Optionally, you can update the cart status on the page here

                            // Update the cart count after adding a book
                            updateCartCount();
                        } else {
                            // Handle the case when the book is already in the cart
                            Swal.fire({
                                icon: 'warning',
                                title: 'Book Already in Cart',
                                text: 'This book is already in your cart.',
                            });
                        }
                    },
                    error: function() {
                        // Handle any errors that may occur during the AJAX request
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while adding the book to your cart.',
                        });
                    }
                });
                @else
                // Redirect unauthenticated users to the login page
                window.location.href = '/login';
                @endauth
            }
        </script>

@endsection
