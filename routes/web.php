<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
Route::resource('homepage', HomepageController::class);

Route::get('/movie/akcny', [MovieController::class, 'akcny'])-> name('movie.akcny');
Route::get('/movie/scifi', [MovieController::class, 'scifi'])-> name('movie.scifi');
Route::get('/movie/horror', [MovieController::class, 'horror'])-> name('movie.horror');
Route::get('/movie/success', [MovieController::class, 'success'])-> name('movie.success');
Route::resource('movie', MovieController::class);

Route::get('/review/myreviews', [ReviewController::class, 'myReviews'])-> name('review.myreviews');
Route::resource('review', ReviewController::class);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/movie/{movie}/edit', [MovieController::class, 'edit'])-> name('movie.edit');
    Route::get('/movie/{movie}/destroy', [MovieController::class, 'destroy'])-> name('movie.destroy');
    Route::get('/movie/create', [MovieController::class, 'create'])-> name('movie.create');
    Route::get('/review/{movie}/create', [ReviewController::class, 'create'])-> name('review.create');
    Route::get('/review/{review}/destroy', [ReviewController::class, 'destroy'])-> name('review.destroy');
});

Route::resource('user', UserController::class);
Route::get('/', function() {
    return view('homepage.index');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::group(['middleware' => ['auth']],function() {
//});
