<?php

use Illuminate\Support\Facades\Route;
use Library\Controllers\ViewController;
use Library\Controllers\AuthController;

Route::middleware('web')->group(function() {
    Route::get('/login', function() {
        return view('library::login');
    });
    Route::post('/login', [AuthController::class, 'authenticate']);


    Route::resource('/books', ViewController::class);
});
