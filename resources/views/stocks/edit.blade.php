@extends('layouts\admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">

                    <div class="container">
                        <h2>Edit Stock</h2>
                        <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="book_id">Book ID:</label>
                                <input type="number" name="book_id" class="form-control" value="{{ $stock->book_id }}" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity_in_stock">Quantity in Stock:</label>
                                <input type="number" name="quantity_in_stock" class="form-control" value="{{ $stock->quantity_in_stock }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
