<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\NotesController;

Route::post('/v1/auth/login', LoginController::class);
Route::get('/v1/auth/logout', [LoginController::class, 'logout']);
Route::post('/v1/auth/register', RegisterController::class);

Route::apiResource('/v1/notes', NotesController::class);