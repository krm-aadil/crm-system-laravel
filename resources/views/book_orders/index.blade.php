@extends('layouts.admin')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-8">
                    <div class="py-8">
                        <div class="mb-4 text-2xl font-semibold text-black">Order Details</div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <form action="{{ route('phonebook') }}" method="GET" class="mb-4">
                                <div class="flex items-center">
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ $searchTerm ?? '' }}"
                                        placeholder="Search by order id or name"
                                        class="w-1/3 px-2 py-1 rounded focus:outline-none border border-gray-300"
                                    />
                                    <button type="submit" class=" px-2 py-1 bg-primary text-white rounded hover:bg-blue-600 focus:outline-none">
                                        Search
                                    </button>
                                </div>
                            </form>
                            <div class="mb-4">
                                <label for="statusFilter" class="text-gray-600">Filter by Status:</label>
                                <select id="statusFilter" class="px-2 py-1 border rounded-md">
                                    <option value="all">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>


                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-blue-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Order ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Total Amount
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <!-- ... -->
                                <tbody class="bg-white divide-y divide-gray-200 filterable">
                                <!-- ... -->

                                @foreach ($orders as $order)
                                    <tr data-status="{{ $order->status }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->customer_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->customer_email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ number_format($order->total_amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($order->status === 'pending')
                                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-full">{{ $order->status }}</span>
                                            @else
                                                <span class="bg-green-500 text-white px-2 py-1 rounded-full">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($order->status === 'pending')
                                                <button data-order-id="{{ $order->id }}" class="bg-primary hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full deliver-button">
                                                    Deliver
                                                </button>
                                            @else
                                                <p class="text-black font-bold text-gray-700">Delivered</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.deliver-button').click(function () {
                const button = $(this);
                const orderId = button.data('order-id');

                // Make an AJAX request to update the order status
                $.ajax({
                    type: 'PUT',
                    url: '/book_orders/' + orderId,
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: 'delivered',
                    },
                    success: function () {
                        // Update the status in the table
                        button.text('Delivered');
                        button.prop('disabled', true);

                        // Reload the page after a short delay (e.g., 1000 milliseconds or 1 second)
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                });
            });

            $('#statusFilter').change(function () {
                const selectedStatus = $(this).val();

                // Show/hide table rows based on the selected status
                if (selectedStatus === 'all') {
                    $('.filterable tr').show();
                } else {
                    $('.filterable tr').hide();
                    $(`.filterable tr[data-status="${selectedStatus}"]`).show();
                }
            });
        });
    </script>

@endsection
