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
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\HomeController;


// Home
/*
Route::get('/', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
*/
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Auth
Auth::routes();

// Resources
Route::resource('users', UserController::class);
Route::resource('events', EventController::class);
Route::resource('event-types', EventTypeController::class);


// Events
Route::get('/get-events', [EventController::class, 'getEvents']);
Route::post('/update-events', [EventController::class, 'update'])->name('update-events');
Route::delete('/delete-events', [EventController::class, 'destroy'])->name('delete-events');
