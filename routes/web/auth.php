<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

Route::get('/login', [WebController::class, 'login'])->name('auth.login');
Route::get('/register', [WebController::class, 'register'])->name('auth.register');