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

use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\RegisterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/owner', [EventController::class, 'creatorIndex']);
Route::get('/events/{id}', [EventController::class, 'show'])->whereNumber('id');
Route::get('/events/{id}/members', [EventController::class, 'members'])->whereNumber('id');
Route::get('/events/{id}/join', [EventController::class, 'join'])->whereNumber('id');
Route::get('/events/{id}/leave', [EventController::class, 'leave'])->whereNumber('id');

Route::delete('/events/{id}', [EventController::class, 'destroy'])->whereNumber('id');

Route::post('/events', [EventController::class, 'store']);
Route::put('/events', [EventController::class, 'update']);
Route::delete('/events', [EventController::class, 'destroy']);

// Authorization & registration
Route::post('/auth/login', [LoginController::class, 'login']);
Route::get('/auth/logout', [LoginController::class, 'logout']);
Route::post('/auth/register', [RegisterController::class, 'register']);