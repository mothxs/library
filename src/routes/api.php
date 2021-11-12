<?php

use Illuminate\Support\Facades\Route;
use Library\Controllers\Api\BookApiController;
use Library\Controllers\Api\RentApiController;
use Library\Controllers\Api\UserApiController;
use Library\Controllers\Api\ImageApiController;
use Library\Controllers\Api\AuthorApiController;
use Library\Controllers\Api\PartnerApiController;
use Library\Controllers\Api\EditorialApiController;

Route::middleware(['web', 'auth'])->prefix('api')->group(function() {
    Route::resource('/users', UserApiController::class);
    Route::resource('/books', BookApiController::class);
    Route::resource('/authors', AuthorApiController::class);
    Route::resource('/editorials', EditorialApiController::class);
    Route::resource('/rents', RentApiController::class);
    Route::resource('/partners', PartnerApiController::class);
    Route::post('/images', [ImageApiController::class, 'store']);
});
