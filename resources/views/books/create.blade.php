@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="container">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block font-semibold text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400" value="{{ old('title') }}">
                        </div>

                        <div class="mb-4">
                            <label for="ISBN" class="block font-semibold text-gray-700">ISBN</label>
                            <input type="text" name="ISBN" id="ISBN" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400" value="{{ old('ISBN') }}">
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block font-semibold text-gray-700">Price</label>
                            <input type="text" name="price" id="price" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400" value="{{ old('price') }}">
                        </div>

                        <div class="mb-4">
                            <label for="summary" class="block font-semibold text-gray-700">Summary</label>
                            <textarea name="summary" id="summary" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">{{ old('summary') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="CoverImage" class="block font-semibold text-gray-700">Cover Image</label>
                            <input type="file" name="CoverImage" id="CoverImage" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">
                        </div>

                        <div class="mb-4">
                            <label for="publication_date" class="block font-semibold text-gray-700">Publication Date</label>
                            <input type="date" name="publication_date" id="publication_date" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400" value="{{ old('publication_date') }}">
                        </div>

                        <div class="mb-4">
                            <label for="author_id" class="block font-semibold text-gray-700">Author</label>
                            <select name="author_id" id="author_id" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="genre_id" class="block font-semibold text-gray-700">Genre</label>
                            <select name="genre_id" id="genre_id" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="language_id" class="block font-semibold text-gray-700">Language</label>
                            <select name="language_id" id="language_id" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->language_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
