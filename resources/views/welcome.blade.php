@extends('layouts.home')
@section('content')

    <div x-data="{ cartOpen: false }">
        <!-- Cart button -->
        <div class="px-4 py-2 absolute right-0 top-0 flex items-center">

            <!-- Cart Button -->
            <button @click="cartOpen = !cartOpen" class="btn btm-outline-dark px">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Cart <span class="badge badge-pill badge-dark" id="cart-count">0</span>
            </button>

            <!-- Login/Register/Dashboard Links -->
            <div class="navbar-end top-0 right-0 ml-4">
                @if (Route::has('login'))
                    <div class="flex">
                        @auth
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="font-semibold text-primary hover:text-neutral focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary">Dashboard</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="font-semibold text-primary hover:text-neutral focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary">Dashboard</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="font-semibold text-primary hover:text-neutral focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary"
                               @click.prevent="trackLoginButtonClick">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-primary hover:text-secondary focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

        </div>



        <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
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
                    <a href="{{route('user.dashboard')}}" class="flex items-center justify-center mt-4 px-3 py-2 bg-violet-600 text-white text-sm uppercase font-medium rounded hover:bg-violet-500 focus:outline-none focus:bg-violet-500">
                        <span>Go to Cart <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </form>
            </div>
        </div>



        <main class="my-8">
        <div class="container mx-auto px-6">
            <div class="h-64 rounded-md overflow-hidden bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144')">
                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                    <div class="px-10 max-w-xl">
                        <h2 class="text-2xl text-white font-semibold">Sport Shoes</h2>
                        <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                        <button class="flex items-center mt-4 px-3 py-2 bg-violet-600 text-white text-sm uppercase font-medium rounded hover:bg-violet-500 focus:outline-none focus:bg-violet-500">
                            <span>Shop Now</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="md:flex mt-8 md:-mx-4">
                <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2" style="background-image: url('https://images.unsplash.com/photo-1547949003-9792a18a2601?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                        <div class="px-10 max-w-xl">
                            <h2 class="text-2xl text-white font-semibold">Back Pack</h2>
                            <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                            <button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>Shop Now</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2" style="background-image: url('https://images.unsplash.com/photo-1486401899868-0e435ed85128?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80')">
                    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                        <div class="px-10 max-w-xl">
                            <h2 class="text-2xl text-white font-semibold">Games</h2>
                            <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                            <button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>Shop Now</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
          <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            @foreach ($books as $book)
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <div class="flex items-end justify-end h-56 w-full bg-cover"
                         style="background-image: url('{{ asset('storage/' . $book->CoverImage) }}')">

                        <form id="addToCartForm{{ $book->id }}" data-book-id="{{ $book->id }}" action="{{ route('cart.add', ['book' => $book->id]) }}" method="POST">
                            @csrf
                            <button type="button"
                                    class="p-2 rounded-full bg-violet-600 text-white mx-5 -mb-4 hover:bg-violet-500 focus:outline-none focus:bg-violet-500"
                                    onclick="addToCart({{ $book->id }})">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="px-5 py-3">
                        <a href="{{ route('books.show', ['book' => $book->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $book->title }}</h3>View Details</a>
                        <span class="text-gray-500 mt-2">${{ $book->price }}</span>


                    </div>
                </div>
            @endforeach
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
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

            <script>



                function trackLoginButtonClick() {
                    // Make an AJAX request to track the button click
                    axios.post('{{ route('track.login.button.click') }}')
                        .then(response => {
                            // Handle the response, if needed
                            console.log('Button click tracked successfully.');

                            // Redirect to the login page
                            window.location.href = '{{ route('login') }}';
                        })
                        .catch(error => {
                            // Handle any errors, if they occur
                            console.error('Error tracking button click:', error);
                        });
                }

            </script>




@endsection
