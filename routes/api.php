<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['jwt.refresh'],
], function ($router) {
    Route::post('me', [AuthController::class, 'me']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::post('refresh', [UserController::class, 'refresh']);