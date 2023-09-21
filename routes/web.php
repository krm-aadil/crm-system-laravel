<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
});

Route::get('redirects', [HomeController::class, 'index'])->name('redirects');


//ADMIN ROUTES
Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('admin/users', [UserController::class,'index'])->name('users.index');
Route::get('admin/users/create', [UserController::class,'create'])->name('users.create');
Route::post('admin/users', [UserController::class,'store'])->name('users.store');
Route::get('admin/users/{user}/edit', [UserController::class,'edit'])->name('users.edit');
Route::put('admin/users/{user}', [UserController::class,'update'])->name('users.update');
Route::delete('admin/users/{user}', [UserController::class,'destroy'])->name('users.destroy');



//CRM ROUTES
Route::get('crm/dashboard', function () {
    return view('crm.dashboard');
})->name('crm.dashboard');



//USER ROUTES
Route::get('user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');


// Route to display a list of books
Route::get('/books', [BooksController::class, 'index'])->name('books.index');

// Route to display the book creation form
Route::get('/books/create', [BooksController::class, 'create'])->name('books.create');

// Route to handle the creation of a new book
Route::post('/books', [BooksController::class, 'store'])->name('books.store');

// Route to display the book editing form
Route::get('/books/{book}/edit', [BooksController::class, 'edit'])->name('books.edit');

// Route to update a book
Route::put('/books/{book}', [BooksController::class, 'update'])->name('books.update');

// Route to delete a book
Route::delete('/books/{book}', [BooksController::class, 'destroy'])->name('books.destroy');
