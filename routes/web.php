<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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

//Route::get('/home', [ProductController::class, 'index']);


// Route::middleware(['web', 'auth'])->group(function () {
//     // Route::get('/home', function () {
//     //     return view('/home');
//     // });
//     Route::get('/home', [ProductController::class, 'index']);
//     Route::view('/admin-dashboard', 'admin-dashboard');
// });

Route::middleware(['web', 'auth', 'user'])->group(function () {
    Route::get('/home', [ProductController::class, 'index']);
});

Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::view('/admin-dashboard', 'admin-dashboard');
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


