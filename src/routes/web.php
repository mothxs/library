<?php

use Illuminate\Support\Facades\Route;
use Library\Controllers\UserController;

Route::middleware('web')->group(function() {
    Route::resource('/users', UserController::class);
});
