<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\NotesController;
use App\Http\Controllers\Api\V1\ProfileController;

Route::prefix('/v1')->group(function () {

    Route::post('/auth', [AuthController::class, 'login']);

    Route::prefix('/auth')->group(function() {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::post('/register', RegisterController::class);
    });

    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'delete']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);
    
    Route::apiResource('/notes', NotesController::class);

});