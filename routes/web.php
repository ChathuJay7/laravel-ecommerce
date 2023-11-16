<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
});



Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['web', 'auth', 'user'])->group(function () {
    
    Route::get('/home', [ProductController::class, 'index']);
    Route::get('/home/search', [ProductController::class, 'search']);
    
    Route::get('/product/{id}', [ProductController::class, 'singleProductView']);

    Route::get('/add-to-cart/{productId}', [CartController::class, 'addToCart']);
    Route::get('/cart/{id}', [CartController::class, 'cartView']);
    Route::get('/remove-cart-item/{id}', [CartController::class, 'removeCartItem']);

    Route::get('/place-order/{id}', [OrderController::class, 'placeOrderView']);
    Route::get('/place-order', [OrderController::class, 'placeOrder']);
    Route::get('/orders', [OrderController::class, 'orderView']);

    Route::get('/update-user-details/{id}', [UserController::class, 'updateUserDetailsView']);
    Route::put('/update-user-details/{id}', [UserController::class, 'updateUserDetails']);
    Route::get('/update-user-password/{id}', [UserController::class, 'updateUserPasswordView']);
    Route::put('/update-user-password/{id}', [UserController::class, 'updateUserPassword']);

    
});



Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [ProductController::class, 'index']);

    Route::get('/admin-product', [ProductController::class, 'adminProductView']);
    Route::get('/admin-product/search', [ProductController::class, 'search']);
    Route::get('/add-new-product', [ProductController::class, 'addNewProductView']);
    Route::post('/add-new-product', [ProductController::class, 'addNewProduct']);

    Route::get('/admin-user', [UserController::class, 'adminUserView']);
    Route::get('/admin-user/search', [UserController::class, 'search']);
    Route::get('/add-new-user', [UserController::class, 'addNewUserView']);
    Route::post('/add-new-user', [UserController::class, 'addNewUser']);

    Route::get('/admin-update-product/{id}', [ProductController::class, 'updateProductView']);
    Route::put('/admin-update-product/{id}', [ProductController::class, 'updateProduct']);
    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

    Route::get('/admin-update-user/{id}', [UserController::class, 'updateUserView']);
    Route::put('/admin-update-user/{id}', [UserController::class, 'updateUserAdmin']);
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);

    Route::get('/admin-single-user/{id}', [UserController::class, 'userDetails']);
});


