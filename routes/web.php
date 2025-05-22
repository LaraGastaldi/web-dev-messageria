<?php

use App\Http\Controllers\View\AuthController;
use App\Http\Controllers\View\MessagesController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');