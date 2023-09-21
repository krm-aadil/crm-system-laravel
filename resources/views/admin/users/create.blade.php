@extends('layouts\admin')

@section('title', 'Create User')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-8">
                <h1 class="text-2xl font-bold mb-4">Create User</h1>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block font-semibold text-gray-700">Role</label>
                        <select name="role" id="role" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="crm">CRM</option>
                        </select>
                    </div>

                    <div class="py-3">
                        <button type="submit" class="bg-teal-800 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


