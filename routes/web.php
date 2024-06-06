<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Auth;
use App\Http\Controllers\Web\NotesController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::get('/', HomeController::class)->name('home');

Route::prefix('/auth')->group(function() {
    Route::get('/signin', Auth\SignInController::class)
        ->middleware(RedirectIfAuthenticated::class)
        ->name('auth.signin');
    Route::get('/signup', Auth\SignUpController::class)
        ->middleware(RedirectIfAuthenticated::class)
        ->name('auth.signup');
});

Route::singleton('/profile', ProfileController::class);
Route::get('/profile/editpassword', [ProfileController::class, 'editpassword'])
    ->name('profile.editpassword');

Route::resource('/notes', NotesController::class)
    ->except(['store', 'index', 'destroy', 'show']);