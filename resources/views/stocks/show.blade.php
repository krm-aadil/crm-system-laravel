@extends('layouts\admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">

                    <div class="container">
                        <h2>Stock Details</h2>
                        <table class="table mt-3">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $stock->id }}</td>
                            </tr>
                            <tr>
                                <th>Book ID</th>
                                <td>{{ $stock->book_id }}</td>
                            </tr>
                            <tr>
                                <th>Quantity in Stock</th>
                                <td>{{ $stock->quantity_in_stock }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('stocks.index') }}" class="btn btn-primary">Back to List</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
