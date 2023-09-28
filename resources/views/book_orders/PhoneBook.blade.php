@extends('layouts.admin')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-8">

                    <form action="{{ route('phonebook') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <input
                                type="text"
                                name="search"
                                value="{{ $searchTerm ?? '' }}"
                                placeholder="Search by Customer Name"
                                class="w-1/3 px-2 py-1 rounded focus:outline-none border border-gray-300"
                            />
                            <button type="submit" class=" px-2 py-1 bg-primary text-white rounded hover:bg-blue-600 focus:outline-none">
                                Search
                            </button>
                        </div>
                    </form>

                    <div class="py-8">
                        <div class="mb-4 text-2xl font-semibold text-blue-600">Customer Phone book </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-blue-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer Address
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Customer Phone Number
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
                                            {{ $order->customer_address }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $order->customer_phone }}
                                        </td>


                                    </tr>
                                @endforeach
                                {{ $orders->links() }}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
