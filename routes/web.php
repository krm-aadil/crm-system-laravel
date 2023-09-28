<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StockController;
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

//Route::get('/', function () {
//    return view('welcome');})->name('welcome');

Route::get('/', [BooksController::class, 'welcome'])->name('welcome');


Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
});

Route::get('redirects', [HomeController::class, 'index'])->name('redirects');


//ADMIN ROUTES
Route::get('dashboard/analytics', [AdminController::class, 'analytics'])->name('analytics');


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
Route::get('user/dashboard', [HomeController::class, 'user_dashboard'])->name('user.dashboard');
//user cart routes


Route::post('add-to-cart/{book}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view-cart');
Route::get('remove-from-cart/{book}', [CartController::class, 'removeFromCart'])->name('cart.remove');


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

//Route to a single book
Route::get('/books/{book}', [BooksController::class, 'show'])->name('books.show');

//Route to search all books
Route::get('/search', [BooksController::class, 'search'])->name('books.search');

//checkout routes
Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});


//cart routes
Route::get('/cart/update/{cartItemId}', [CartController::class,'updateCartItem'])->name('cart.update');
Route::delete('cart/remove/{cartItemId}', [CartController::class, 'removeCartItem'])->name('cart.remove');
Route::get('cart/count', [CartController::class, 'getCartCount'])->name('cart.count');


//book_orders routes
Route::get('/book_orders', [OrdersController::class, 'index'])->name('book-orders');
Route::put('/book_orders/{order}', [OrdersController::class, 'updateStatus']);

//Route::post('/send-email-notification', 'OrderController@sendEmailNotification');


//analytics
Route::post('/track-login-button-click', [ClickController::class,'trackClick'])->name('track.login.button.click');
