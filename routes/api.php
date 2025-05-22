<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth'],
], function ($router) {
    Route::post('me', [AuthController::class, 'me']);
    Route::patch('user/avatar', [UserController::class, 'updateAvatar']);
});

Route::group([
    'middleware' => 'throttle:10,1',
], function ($router) {
    Route::post('register', [UserController::class, 'register']);
});
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);