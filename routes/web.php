<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvShowController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PersonController;




Route::get('/', [MovieController::class, 'home'])->name('home');


Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');


Route::get('/tv-shows', [TvShowController::class, 'index'])->name('tv-shows.index');


Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/people', [PersonController::class, 'index'])->name('people.index');