<?php

use Illuminate\Support\Facades\Route;
use Library\Controllers\AuthController;
use Library\Controllers\UserController;

Route::middleware('web')->group(function() {
    Route::get('/login', function() {
        return view('library::login');
    });
    Route::post('/login', [AuthController::class, 'authenticate']);


    Route::resource('/users', UserController::class);
});
