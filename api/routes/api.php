<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\CategoryContoller;
use App\Http\Controllers\Api\V1\CommentController;
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
    Route::apiResource('categories', CategoryContoller::class);

    Route::prefix('comments')->group(function () {
        Route::apiResource('/', CommentController::class)->parameters(['' => 'comment']);

        Route::post('{comment}/react', [CommentController::class, 'react']);

        Route::delete('{comment}/removeReaction', [CommentController::class, 'removeReaction']);
    });

    Route::prefix('movies')->group(function () {
        Route::apiResource('/', MovieController::class)->parameters(['' => 'movie']);

        Route::post('{movie}/react', [MovieController::class, 'react']);

        Route::delete('{movie}/removeReaction', [MovieController::class, 'removeReaction']);

        Route::post('{movie}/watched', [MovieController::class, 'watched']);

        Route::delete('{movie}/unWatch', [MovieController::class, 'unWatch']);

    });
    
    Route::prefix('users')->group(function () {
        Route::apiResource('/', UserController::class)->parameters(['' => 'user']);

        Route::post('{user}/avatar', [UserController::class, 'updateAvatar']);
    });
});