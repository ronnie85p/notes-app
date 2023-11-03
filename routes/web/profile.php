<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\SettingsController;
use App\Http\Controllers\Profile\FeedbackController;
use App\Http\Controllers\Profile\BookController;
use App\Http\Controllers\Profile\CategoryController;

/**
 *  
 * Метод	    URI	                    Действие	   Имя маршрута
 * GET	        /photos	                 index	       photos.index
 * GET	        /photos/create	         create	       photos.create
 * POST	        /photos	                 store	       photos.store
 * GET	        /photos/{photo}	         show	       photos.show
 * GET	        /photos/{photo}/edit	 edit	       photos.edit
 * PUT/PATCH	/photos/{photo}	         update	       photos.update
 * DELETE	    /photos/{photo}	         destroy	   photos.destroy
 */

Route::prefix('/profile')
    ->name('profile.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/settings', [ProfileController::class, 'showSettings'])->name('settings.show');

        Route::resources([
            '/books'      => BookController::class,
            '/feedbacks'  => FeedbackController::class,
            '/categories' => CategoryController::class,
        ]);
});