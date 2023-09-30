<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Checkout Form -->
            <div class="bg-blue-100 shadow-md rounded-lg p-6">
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
                            <button type="button" class="btn btn-primary" onclick="decreaseQuantity({{ $cartItem->id }})">-</button>
                            <button type="button" class="btn btn-primary" onclick="increaseQuantity({{ $cartItem->id }})">+</button>
                            <button type="button" class="btn btn-primary" onclick="removeItem({{ $cartItem->id }})">Remove</button>
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
                                   class="form-radio text-primary">
                            <span class="ml-2">Cash on Delivery</span>
                        </label>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="bg-primary hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-blue-400 shadow-md rounded-lg p-6">
                <img src="{{asset('img/young-girl-reading-a-book-while-sitting-on-chair-3d-character-illustration-png.png')}}" alt="Image" class="w-full h-auto">
            </div>
            <div class="bg-blue-400 shadow-md rounded-lg p-6">
                <img src="{{asset('img/man-and-woman-sitting-on-big-pile-of-books-using-tablet-laptop-and-book-3d-character-illustration-png.png')}}" alt="Image" class="w-full h-auto">
            </div>
            <!-- Purchase History -->
            <div class="bg-blue-200 shadow-md rounded-lg p-6 ">
                <h2 class="text-2xl font-semibold mb-4">Purchase History</h2>
                <div class="overflow-x-auto rounded-2xl">
                    <table class="min-w-full rounded-lg">
                        <thead >
                        <tr>
                            <th class="px-6 py-3 bg-blue-300 text-left text-xs leading-4 font-medium text-black uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 bg-blue-300 text-left text-xs leading-4 font-medium text-black uppercase tracking-wider">
                                Total Amount
                            </th>
                            <th class="px-6 py-3 bg-blue-300 text-left text-xs leading-4 font-medium text-black uppercase tracking-wider">
                                Book Title
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($purchaseHistory as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">${{ $order->total_amount }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $order->book->title }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <script>
        // Function to decrease the quantity of a cart item
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
                // Send an AJAX request to update the cart item quantity on the server
                updateCartItemQuantity(cartItemId, currentQuantity - 1);
            }
        }

        // Function to increase the quantity of a cart item
        function increaseQuantity(cartItemId) {
            const quantityElement = document.getElementById(`quantity${cartItemId}`);
            const subtotalElement = document.getElementById(`subtotal${cartItemId}`);
            const currentQuantity = parseInt(quantityElement.textContent);

            // Increase the quantity
            quantityElement.textContent = currentQuantity + 1;
            // Recalculate and update the subtotal
            const newSubtotal = parseFloat(subtotalElement.textContent) + parseFloat(subtotalElement.textContent) / currentQuantity;
            subtotalElement.textContent = newSubtotal.toFixed(2);
            // Update the total amount
            updateTotalAmount();
            // Send an AJAX request to update the cart item quantity on the server
            updateCartItemQuantity(cartItemId, currentQuantity + 1);
        }

        // Function to remove a cart item
        function removeItem(cartItemId) {
            // You can use JavaScript to remove the item from the DOM
            const itemElement = document.getElementById(`cartItem${cartItemId}`);
            itemElement.remove();

            // Send an AJAX request to remove the item from the server-side cart
            removeCartItem(cartItemId);

            // Show a SweetAlert success notification after item removal
            Swal.fire({
                icon: 'success',
                title: 'Item Removed',
                text: 'The item has been successfully removed from your cart.',
            });

            // Update the total amount
            updateTotalAmount();
        }

        // Function to send an AJAX request to update cart item quantity on the server
        function updateCartItemQuantity(cartItemId, newQuantity) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post(`/cart/update/${cartItemId}`, { quantity: newQuantity, _token: csrfToken })
                .then(response => {
                    // Handle the response (e.g., update the cart total on the page)
                })
                .catch(error => {
                    // Handle errors
                });
        }

        // Function to send an AJAX request to remove a cart item from the server-side cart
        function removeCartItem(cartItemId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post(`/cart/remove/${cartItemId}`, { _token: csrfToken })
                .then(response => {
                    // Handle the response (e.g., update the cart total on the page)
                })
                .catch(error => {
                    // Handle errors
                });
        }

        // Function to update the total amount
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
