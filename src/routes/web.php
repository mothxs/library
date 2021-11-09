<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Library\Controllers\AuthController;
use Library\Controllers\ViewController;

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware('web')->group(function() {
    Route::get('/login', function() {
        if(Auth::user()) {
            return redirect('/library/books');
        }
        return view('library::login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['web','auth'])->group(function() {
    Route::get('library/{view}', [ViewController::class, 'index']);
});