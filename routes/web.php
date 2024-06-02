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
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth as _Auth;

Route::get('/', HomeController::class)->name('home');

Route::get('/auth/signin', Auth\SignInController::class)
    ->middleware(RedirectIfAuthenticated::class)->name('auth.signin');
Route::get('/auth/signup', Auth\SignUpController::class)
    ->middleware(RedirectIfAuthenticated::class)->name('auth.signup');

Route::resource('/notes', NotesController::class)->except(['store', 'index', 'destroy', 'show']);