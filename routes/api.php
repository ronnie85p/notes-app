<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\NotesController;

Route::prefix('/v1')->group(function () {

    Route::prefix('/auth')->group(function() {
        Route::post('/login', LoginController::class);
        Route::get('/logout', [LoginController::class, 'logout']);
        Route::post('/register', RegisterController::class);
    });
    
    Route::apiResource('/notes', NotesController::class);
    
});