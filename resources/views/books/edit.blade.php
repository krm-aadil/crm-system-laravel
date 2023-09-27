@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="container">
                    <h1 class="text-3xl font-semibold mb-6">Edit Book</h1>

                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data"
                          class="space-y-6">
                        @csrf
                        @method('PUT')


                        <div class="flex flex-col">
                            <label for="name" class="text-lg font-medium">title</label>
                            <input type="text" name="name" id="name" class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-400"
                                   value="{{ $book->title }}">
                        </div>

                        <div class="mb-4">
                            <label for="ISBN" class="block font-semibold text-gray-700">ISBN</label>
                            <input type="text" name="ISBN" id="ISBN" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400"
                                   value="{{ $book->ISBN }}">
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block font-semibold text-gray-700">Price</label>
                            <input type="text" name="price" id="price" class="w-full rounded-lg border-gray-300
                             focus:outline-none focus:border-teal-400" value="{{ $book->price }}">
                        </div>

                        <div class="mb-4">
                            <label for="summary" class="block font-semibold text-gray-700">Summary</label>
                            <textarea name="summary" id="summary" class="w-full rounded-lg border-gray-300
                             focus:outline-none focus:border-teal-400">{{ $book->summary}}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="CoverImage" class="block font-semibold text-gray-700">Cover Image</label>
                            <input type="file" name="CoverImage" id="CoverImage" class="w-full rounded-lg
                            border-gray-300 focus:outline-none focus:border-teal-400">
                        </div>

                        <div class="mb-4">
                            <label for="publication_date" class="block font-semibold text-gray-700">Publication Date</label>
                            <input type="date" name="publication_date" id="publication_date" class="w-full
                            rounded-lg border-gray-300 focus:outline-none focus:border-teal-400"
                                   value="{{ $book->publication_date }}">
                        </div>







                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
