<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class);

    Route::post('register', RegisterController::class);

    Route::post('logout', LogoutController::class)->middleware('auth:sanctum');
});

Route::prefix('v1')->group(function () {
    Route::apiResource('movies', MovieController::class);
    
    Route::apiResource('users', UserController::class);

    Route::post('users/{user}/avatar', [UserController::class, 'updateAvatar']);
});