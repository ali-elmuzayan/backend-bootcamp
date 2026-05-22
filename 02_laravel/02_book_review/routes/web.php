<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => redirect()->route('books.index'))->name('home');

Route::resource('books', BookController::class);
Route::resource('books.reviews', ReviewController::class)
    ->scoped(['review' => 'book'])
    ->only('create', 'store'); 