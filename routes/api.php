<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\Api\Products\CategoryController;
use App\Http\Controllers\Api\Products\BookController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    '/books' => BookController::class,
    '/categories' => CategoryController::class,
    '/feedbacks' => FeedbackController::class,
]);

// Settings
Route::post('/profile/settings', [ProfileController::class, 'updateSettings']);

// Authorization & registration
Route::put('/auth', [LoginController::class, 'login']);
Route::get('/auth', [LoginController::class, 'logout']);
Route::post('/auth', [RegisterController::class, 'register']);