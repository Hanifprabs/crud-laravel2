<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard'); // Make sure to create the dashboard.blade.php view
})->middleware('auth');

// Redirect root route to dashboard
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

// Authentication routes
Auth::routes();

Route::get('/posts', function () {
    return view('index'); // Ensure the view exists at resources/views/crud/index.blade.php
})->middleware('auth'); // Optional auth middleware if you want it to be protected

Route::get('/posts', function () {
    return view('create'); // Ensure the view exists at resources/views/crud/index.blade.php
})->middleware('auth'); // Optional auth middleware if you want it to be protected


// Home route (optional if not used)
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Resource route for posts
Route::resource('/posts', PostController::class)->middleware('auth');
