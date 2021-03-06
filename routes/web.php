<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

// comment route only for authenticated user
Route::put('/comment/{new_id}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store')->middleware('auth');

Route::get('/news/search', [\App\Http\Controllers\NewsController::class, 'search'])->name('news.search');

// whole newsController only accessible by publisher
Route::middleware(['publisher'])->group(function () {
    Route::resource('news', 'App\Http\Controllers\NewsController');
});

// and exception to view single article for everyone
Route::get('/{slug}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
