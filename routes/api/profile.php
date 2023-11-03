<?php
use Illuminate\Support\Facades\Route;
use App\Controllers\Api\Products\BookController;

Route::apiResources([
    '/books' => BookController::class,
    '/messages' => MessageController::class,
]);