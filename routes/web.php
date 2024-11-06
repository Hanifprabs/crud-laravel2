<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

// Rute dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Pastikan untuk membuat tampilan dashboard.blade.php
})->middleware('auth');

// Redirect rute root ke dashboard
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

// Rute otentikasi
Auth::routes();

// Rute home (opsional jika tidak digunakan)
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Rute resource untuk posting
Route::resource('/posts', PostController::class)->middleware('auth');

// Rute untuk menghasilkan PDF
Route::resource('posts', PostController::class);

// Route for printing the posts as PDF
Route::get('views/posts/cetak', [PostController::class, 'cetak'])->name('posts.cetak');

// Rute untuk menampilkan tabel data mahasiswa
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');