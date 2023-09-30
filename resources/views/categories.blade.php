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
                    <a href="{{route('user.dashboard')}}" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span>Go to Cart <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </form>
            </div>
        </div>
        <div class="mt-16">
            <h3 class=" px-5 text-gray-600 text-2xl font-medium"> Action Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($ActionBooks as $ActionBook)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             style="background-image: url('{{ asset('storage/' . $ActionBook->CoverImage) }}')">

                            <form id="addToCartForm{{ $ActionBook->id }}" data-book-id="{{ $ActionBook->id }}" action="{{ route('cart.add', ['book' => $ActionBook->id]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        class="p-2 rounded-full bg-primary text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                                        onclick="addToCart({{ $ActionBook->id }})">
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
                            <a href="{{ route('books.show', ['book' => $ActionBook->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $ActionBook->title }}</h3>View Details</a>
                            <span class="text-gray-500 mt-2">${{ $ActionBook->price }}</span>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-16">
            <h3 class=" px-5 text-gray-600 text-2xl font-medium"> Drama Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($DramaBooks as $DramaBook)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             style="background-image: url('{{ asset('storage/' . $DramaBook->CoverImage) }}')">

                            <form id="addToCartForm{{ $DramaBook->id }}" data-book-id="{{ $DramaBook->id }}" action="{{ route('cart.add', ['book' => $DramaBook->id]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        class="p-2 rounded-full bg-primary text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                                        onclick="addToCart({{ $DramaBook->id }})">
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
                            <a href="{{ route('books.show', ['book' => $DramaBook->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $DramaBook->title }}</h3>View Details</a>
                            <span class="text-gray-500 mt-2">${{ $DramaBook->price }}</span>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-16">
            <h3 class=" px-5 text-gray-600 text-2xl font-medium">Comedy Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($ComedyBooks as $ComedyBook)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             style="background-image: url('{{ asset('storage/' . $ComedyBook->CoverImage) }}')">

                            <form id="addToCartForm{{ $ComedyBook->id }}" data-book-id="{{ $ComedyBook->id }}" action="{{ route('cart.add', ['book' => $ComedyBook->id]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        class="p-2 rounded-full bg-primary text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                                        onclick="addToCart({{ $ComedyBook->id }})">
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
                            <a href="{{ route('books.show', ['book' => $ComedyBook->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $ComedyBook->title }}</h3>View Details</a>
                            <span class="text-gray-500 mt-2">${{ $ComedyBook->price }}</span>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-16">
            <h3 class=" px-5 text-gray-600 text-2xl font-medium"> Horror Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($HorrorBooks as $HorrorBook)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             style="background-image: url('{{ asset('storage/' . $HorrorBook->CoverImage) }}')">

                            <form id="addToCartForm{{ $HorrorBook->id }}" data-book-id="{{ $HorrorBook->id }}" action="{{ route('cart.add', ['book' => $HorrorBook->id]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        class="p-2 rounded-full bg-primary text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                                        onclick="addToCart({{$HorrorBook->id }})">
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
                            <a href="{{ route('books.show', ['book' => $HorrorBook->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $HorrorBook->title }}</h3>View Details</a>
                            <span class="text-gray-500 mt-2">${{ $HorrorBook->price }}</span>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-16">
            <h3 class=" px-5 text-gray-600 text-2xl font-medium"> Mystery Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($MysteryBooks as $MysteryBook)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             style="background-image: url('{{ asset('storage/' . $MysteryBook->CoverImage) }}')">

                            <form id="addToCartForm{{ $MysteryBook->id }}" data-book-id="{{$MysteryBook->id }}" action="{{ route('cart.add', ['book' => $MysteryBook->id]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        class="p-2 rounded-full bg-primary text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                                        onclick="addToCart({{$MysteryBook->id }})">
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
                            <a href="{{ route('books.show', ['book' => $MysteryBook->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $MysteryBook->title }}</h3>View Details</a>
                            <span class="text-gray-500 mt-2">${{ $MysteryBook->price }}</span>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>



        <div class="mt-16">
            <h3 class=" px-5 text-gray-600 text-2xl font-medium"> Thriller Books</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($ThrillerBooks as $ThrillerBook)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                             style="background-image: url('{{ asset('storage/' . $ThrillerBook->CoverImage) }}')">

                            <form id="addToCartForm{{ $ThrillerBook->id }}" data-book-id="{{$ThrillerBook->id }}" action="{{ route('cart.add', ['book' => $ThrillerBook->id]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        class="p-2 rounded-full bg-primary text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
                                        onclick="addToCart({{$ThrillerBook->id }})">
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
                            <a href="{{ route('books.show', ['book' => $ThrillerBook->id]) }}"> <h3 class="text-gray-700 uppercase">{{ $ThrillerBook->title }}</h3>View Details</a>
                            <span class="text-gray-500 mt-2">${{ $ThrillerBook->price }}</span>


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

@endsection
