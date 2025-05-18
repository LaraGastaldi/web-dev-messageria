<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['jwt.refresh'],
], function ($router) {
    Route::post('me', [AuthController::class, 'me']);
    Route::patch('user/avatar', [UserController::class, 'updateAvatar']);
});

Route::post('register', [UserController::class, 'register'])->withMiddleware('throttle:10,1');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);