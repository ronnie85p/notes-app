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

use App\Http\Controllers\WebController;
use App\Http\Controllers\Products\BookController;
use App\Http\Controllers\Profile\CategoryController;
use App\Http\Controllers\ProfileController;

require_once __DIR__ . '/web/auth.php';
require_once __DIR__ . '/web/profile.php';


// home
Route::get('/', [WebController::class, 'index'])->name('home');


// feedback
Route::get('/feedback', [WebController::class, 'feedback'])->name('feedback');

// books
Route::resource('/books', BookController::class);