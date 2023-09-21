@extends('layouts\admin')

@section('title', 'Create User')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container p-8">
                <h1 class="text-2xl font-bold mb-4">Edit User</h1>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400" value="{{ $user->name }}">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400" value="{{ $user->email }}">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block font-semibold text-gray-700">Role</label>
                        <select name="role" id="role" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-teal-400">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="crm" {{ $user->role === 'crm' ? 'selected' : '' }}>CRM</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 rounded-md bg-teal-800 text-white font-semibold hover:bg-teal-800 focus:outline-none focus:bg-teal-800">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
