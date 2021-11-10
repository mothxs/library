<?php

use Illuminate\Support\Facades\Route;
use Library\Controllers\Api\AuthorApiController;
use Library\Controllers\Api\BookApiController;
use Library\Controllers\Api\CategoryApiController;
use Library\Controllers\Api\EditorialApiController;
use Library\Controllers\Api\RentApiController;
use Library\Controllers\Api\UserApiController;

Route::middleware(['web', 'auth'])->prefix('api')->group(function() {
    Route::resource('/users', UserApiController::class);
    Route::resource('/books', BookApiController::class);
    Route::resource('/authors', AuthorApiController::class);
    Route::resource('/categories', CategoryApiController::class);
    Route::resource('/editorial', EditorialApiController::class);
    Route::resource('/rents', RentApiController::class);
});
