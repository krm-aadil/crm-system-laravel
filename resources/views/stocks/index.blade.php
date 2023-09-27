@extends('layouts\admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="container">
                        <h2 class="text-2xl font-semibold">Stocks</h2>
                        <a href="{{ route('stocks.create') }}" class="btn btn-primary my-3">Add Stock</a>
                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Book ID</th>
                                <th class="px-4 py-2">Quantity in Stock</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td class="px-4 py-2">{{ $stock->book->title }}</td>
                                    <td class="px-4 py-2">{{ $stock->stock_id }}</td>
                                    <td class="px-4 py-2">{{ $stock->quantity_in_stock }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('stocks.edit', ['stock' => $stock->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('stocks.destroy',['stock' => $stock->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
