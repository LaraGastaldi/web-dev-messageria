<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');
Route::group([
    'middleware' => 'jwt.renew'
], function () {
    Route::get('/messages', function () {
        return view('messages');
    })->name('messages');
});
Route::get('/register', function () {
    return view('pages.register');
})->name('register');