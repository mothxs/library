<?php

use Illuminate\Support\Facades\Route;
use Library\Controllers\Api\UserApiController;

Route::middleware('web')->prefix('api')->group(function() {
    Route::resource('/users', UserApiController::class);
});
