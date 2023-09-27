<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Hello !!') }} {{ Auth::user()->name }}--}}
{{--        </h2>--}}

{{--    </x-slot>--}}
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-semibold mb-4">Checkout</h2>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <!-- Customer Details -->
                <div class="mb-4">
                    <label for="customer_name" class="block text-gray-700 font-bold mb-2">Name:</label>
                    <input type="text" name="customer_name" id="customer_name" placeholder="Full Name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="customer_email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" name="customer_email" id="customer_email" placeholder="Email Address"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="customer_address" class="block text-gray-700 font-bold mb-2">Address:</label>
                    <input type="text" name="customer_address" id="customer_address" placeholder="Shipping Address"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="customer_phone" class="block text-gray-700 font-bold mb-2">Phone:</label>
                    <input type="text" name="customer_phone" id="customer_phone" placeholder="Phone Number"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>



                <!-- Cart Information -->
                <h3 class="text-lg font-semibold mb-4">Cart Items:</h3>
                @php
                    $totalAmount = 0; // Initialize the total amount
                @endphp
                @foreach ($cartItems as $cartItem)
                    <div class="mb-4" id="cartItem{{ $cartItem->id }}">
                        <p class="text-gray-700">{{ $cartItem->book->title }} (Qty: <span id="quantity{{ $cartItem->id }}">{{ $cartItem->quantity }}</span>)</p>
                        <!-- Calculate and display the subtotal for each item -->
                        <p class="text-gray-700">Subtotal: $<span id="subtotal{{ $cartItem->id }}">{{ $cartItem->book->price * $cartItem->quantity }}</span></p>
                        <!-- Add buttons to increase, decrease, or remove the item -->
                        <button type="button" onclick="decreaseQuantity({{ $cartItem->id }})">-</button>
                        <button type="button" onclick="increaseQuantity({{ $cartItem->id }})">+</button>
                        <button type="button" onclick="removeItem({{ $cartItem->id }})">Remove</button>
                    </div>
                    @php
                        $totalAmount += $cartItem->book->price * $cartItem->quantity; // Update the total amount
                    @endphp
                @endforeach
                <!-- Display the total amount -->
                <h3 class="text-lg font-semibold mb-4">Total Amount:</h3>
                <p class="text-gray-700 font-semibold text-xl" id="totalAmount">${{ $totalAmount }}</p>



                <!-- Payment Method -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Payment Method:</label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="payment_method" value="cash_on_delivery" checked
                               class="form-radio text-indigo-600">
                        <span class="ml-2">Cash on Delivery</span>
                    </label>
                </div>

                <div class="mt-6">
                    <button type="submit"
                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function decreaseQuantity(cartItemId) {
            const quantityElement = document.getElementById(`quantity${cartItemId}`);
            const subtotalElement = document.getElementById(`subtotal${cartItemId}`);
            const currentQuantity = parseInt(quantityElement.textContent);

            if (currentQuantity > 1) {
                // Decrease the quantity if it's greater than 1
                quantityElement.textContent = currentQuantity - 1;
                // Recalculate and update the subtotal
                const newSubtotal = parseFloat(subtotalElement.textContent) - parseFloat(subtotalElement.textContent) / currentQuantity;
                subtotalElement.textContent = newSubtotal.toFixed(2);
                // Update the total amount
                updateTotalAmount();
                // You can also update the corresponding form input here if needed
            }
        }

        function increaseQuantity(cartItemId) {
            const quantityElement = document.getElementById(`quantity${cartItemId}`);
            const subtotalElement = document.getElementById(`subtotal${cartItemId}`);
            const currentQuantity = parseInt(quantityElement.textContent);
            const price = parseFloat(subtotalElement.textContent) / currentQuantity;

            // Increase the quantity
            quantityElement.textContent = currentQuantity + 1;
            // Recalculate and update the subtotal
            const newSubtotal = price * (currentQuantity + 1);
            subtotalElement.textContent = newSubtotal.toFixed(2);
            // Update the total amount
            updateTotalAmount();
            // You can also update the corresponding form input here if needed
        }

        function removeItem(cartItemId) {
            // You can use JavaScript to remove the item from the DOM
            const itemElement = document.getElementById(`cartItem${cartItemId}`);
            itemElement.remove();

            // Send an AJAX request to remove the item from the server-side cart
            // You can use Axios or another JavaScript library to make the request
            axios.post(`/cart/remove/${cartItemId}`)
                .then(response => {
                    // Handle the response (e.g., update the cart total)
                })
                .catch(error => {
                    // Handle errors
                });

            // Update the total amount
            updateTotalAmount();
        }

        function updateTotalAmount() {
            let totalAmount = 0;
            const subtotalElements = document.querySelectorAll('[id^="subtotal"]');

            subtotalElements.forEach(subtotalElement => {
                totalAmount += parseFloat(subtotalElement.textContent);
            });

            // Update the total amount displayed on the page
            const totalAmountElement = document.getElementById('totalAmount');
            totalAmountElement.textContent = `$${totalAmount.toFixed(2)}`;
        }
    </script>


</x-app-layout>
