<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/', 'home');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Route::middleware(['role:user'])->group(function () {
//     Route::view('/', 'home')->middleware('role:user');
// });

// Route::middleware(['role:user'])->group(function () {
//     Route::view('/', 'home');
//     // Add other routes for users...
// });