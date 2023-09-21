@extends('layouts\admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="mb-4">
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Create Book</a>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>ISBN</th>
                            <th>Price</th>
                            <th>Summary</th>
                            <th>Cover Image</th>
                            <th>Publication Date</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->ISBN }}</td>
                                <td>{{ $book->price }}</td>
                                <td>{{ $book->summary ?? 'N/A' }}</td>
                                <td>
                                    @if ($book->CoverImage)
                                        <img src="{{ asset('storage/' . $book->CoverImage) }}" alt="Book Image" class="w-16 h-16">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $book->publication_date }}</td>
                                <td>{{ $book->author->first_name }} {{ $book->author->last_name }}</td>
                                <td>{{ $book->genre->genre_name }}</td>
                                <td>{{ $book->language->language_name }}</td>

                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
@endsection
