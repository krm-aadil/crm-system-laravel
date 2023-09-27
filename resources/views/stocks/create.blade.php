@extends('layouts\admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">

                    <div class="container">
                        <h2>Add Stock</h2>
                        <form action="{{ route('stocks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                               <label for="book_id">Book name :</label>
                                 <select name="book_id" id="book_id" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">
                                      @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                      @endforeach
                            </div>
                            <div class="form-group">
                                <label for="quantity_in_stock">Quantity in Stock:</label>
                                <input type="number" name="quantity_in_stock" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
