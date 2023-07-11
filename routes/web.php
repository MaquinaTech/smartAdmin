<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\UserController;

// Welcome
Route::get('/', function () {
    return view('welcome');
});

// Auth
Auth::routes();

// Home
Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

// Resources
Route::resource('users', UserController::class);
