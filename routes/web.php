<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesWebpageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmintoolController;
use App\Http\Controllers\StringhandlingController;

Route::get('/signin', [RegisterController::class, 'showSigninWebpage'])->name('signin');
Route::post('/signin', [RegisterController::class, 'register'])->name('signin.post');

Route::get('/login', [LoginController::class, 'showLoginWebpage'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/netflix', [MoviesWebpageController::class, 'readMovies'])->name('movieslist');
Route::post('/netflix', [MoviesWebpageController::class, 'readMovies'])->name('movieslist.post');
Route::post('/netflix/rate/{title}', [MoviesWebpageController::class, 'rateMovie'])->name('movieslist.post.rate');
Route::delete('/netflix/delete/{id}', [MoviesWebpageController::class, 'deleteMovie'])->name('movieslist.delete');

Route::get('/admintool/save', [AdmintoolController::class, 'showAdmintoolForSave'])->name('admintool');
Route::post('/admintool/save', [AdmintoolController::class, 'createMovie'])->name('admintool.post');
Route::get('/admintool/update', [AdmintoolController::class, 'showAdmintoolForUpdate'])->name('admintool.update');
Route::put('/admintool/update', [AdmintoolController::class, 'updateMovie'])->name('admintool.put');

Route::get('/reduce-string', [StringhandlingController::class, 'showReduceStringView'])->name('reduce-string');
Route::post('/reduce-string', [StringhandlingController::class, 'reduceString'])->name('string');