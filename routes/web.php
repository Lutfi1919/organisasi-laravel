<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

// Route::get('/laporGDS', function () {
//     return view('laporGDS');
// })->name('laporGDS');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [UserController::class, 'login'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function() {
    Route::get('/laporGDS', function() {
        return view('staff.laporGDS');
    })->name('laporGDS');
});
