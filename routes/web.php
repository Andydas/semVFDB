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
Route::get('/movie/filter', [MovieController::class, 'filterMovie'])-> name('movie.filterMovie');
Route::get('/movie/success', [MovieController::class, 'success'])-> name('movie.success');
Route::get('/movie/{movie}/detail', [MovieController::class, 'detail'])-> name('movie.detail');
Route::resource('movie', MovieController::class);

Route::get('/review/myreviews', [ReviewController::class, 'myReviews'])-> name('review.myreviews');
Route::get('/review/filter', [ReviewController::class, 'filterReview'])-> name('review.filterReview');
Route::get('/review/{review}/detail', [ReviewController::class, 'detail'])-> name('review.detail');
Route::resource('review', ReviewController::class);


Route::resource('user', UserController::class);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/movie/{movie}/edit', [MovieController::class, 'edit'])-> name('movie.edit');
    Route::get('/movie/{movie}/destroy', [MovieController::class, 'destroy'])-> name('movie.destroy');
    Route::get('/movie/create', [MovieController::class, 'create'])-> name('movie.create');
    Route::get('/review/{movie}/create', [ReviewController::class, 'create'])-> name('review.create');
    Route::get('/review/{review}/destroy', [ReviewController::class, 'destroy'])-> name('review.destroy');
    Route::get('/review/{review}/edit', [ReviewController::class, 'edit'])-> name('review.edit');

    Route::get('/user/{user}/edit', [UserController::class, 'edit'])-> name('user.edit');
    Route::get('/user/{user}/destroy', [UserController::class, 'destroy'])-> name('user.destroy');
});



Route::get('/', function() {
    return view('homepage.index');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::group(['middleware' => ['auth']],function() {
//});
