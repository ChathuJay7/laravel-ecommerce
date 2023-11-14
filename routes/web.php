<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

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

// Route::view('/login', 'login');
// Route::view('/register', 'register');
//Route::view('/home', 'home');


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['web', 'auth', 'user'])->group(function () {
    Route::get('/home', [ProductController::class, 'index']);

    Route::get('/add-to-cart/{productId}', [CartController::class, 'addToCart']);
});



Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [ProductController::class, 'index']);

    Route::get('/admin-product', [ProductController::class, 'adminProductView']);
    Route::get('/add-new-product', [ProductController::class, 'addNewProductView']);
    Route::post('/add-new-product', [ProductController::class, 'addNewProduct']);

    Route::get('/admin-user', [UserController::class, 'adminUserView']);
    Route::get('/add-new-user', [UserController::class, 'addNewUserView']);
    Route::post('/add-new-user', [UserController::class, 'addNewUser']);

    Route::get('/admin-update-product/{id}', [ProductController::class, 'updateProductView']);
    Route::put('/admin-update-product/{id}', [ProductController::class, 'updateProduct']);
    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

    Route::get('/admin-update-user/{id}', [UserController::class, 'updateUserView']);
    Route::put('/admin-update-user/{id}', [UserController::class, 'updateUserAdmin']);
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);
});



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {
//         return view('/home');
//     });
// });

// Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
//     Route::get('/home', function () {
//         return view('/home');
//     });
//     //Route::get('/list', 'UserController@list')->name('user_list');
// });

// Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'user'], function () {
//     Route::get('/admin', function () {
//         return view('/admin-dashboard');
//     });
//     //Route::get('/list', 'UserController@list')->name('user_list');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/home', function () {
//         return view('home');
//     })->name('home');
// });

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin-dashboard', function () {
//         return view('admin-dashboard');
//     })->name('admin-dashboard');
// });


