<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;

use App\Http\Controllers\Api\V1\Category\CategoryContoller;

use App\Http\Controllers\Api\V1\Comment\CommentController;
use App\Http\Controllers\Api\V1\Comment\LikeController;

use App\Http\Controllers\Api\V1\Movie\MovieController;
use App\Http\Controllers\Api\V1\Movie\LikeController as MovieLikeController;
use App\Http\Controllers\Api\V1\Movie\ReviewController;
use App\Http\Controllers\Api\V1\Movie\WatchedController;
use App\Http\Controllers\Api\V1\Movie\WatchLaterController;

use App\Http\Controllers\Api\V1\MovieList\MovieListController;

use App\Http\Controllers\Api\V1\User\AvatarController;
use App\Http\Controllers\Api\V1\User\FollowController;
use App\Http\Controllers\Api\V1\User\UserController;

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

        Route::post('{comment}/reaction', [LikeController::class, 'reaction']);

        Route::delete('{comment}/removeReaction', [LikeController::class, 'removeReaction']);
    });

    Route::prefix('movies')->group(function () {
        Route::apiResource('/', MovieController::class)->parameters(['' => 'movie']);

        Route::prefix('{movie}')->group(function() {
            Route::post('reaction', [MovieLikeController::class, 'reaction']);
            
            Route::delete('removeReaction', [MovieLikeController::class, 'removeReaction']);

            Route::apiResource('reviews', ReviewController::class);
            
            Route::post('watched', [WatchedController::class, 'watched']);
            
            Route::delete('unWatch', [WatchedController::class, 'unWatch']);
            
            Route::post('watchLater', [WatchLaterController::class, 'store']);
            
            Route::delete('watchLater', [WatchLaterController::class, 'destroy']);
        });
    });
    
    Route::prefix('users')->group(function () {
        Route::apiResource('/', UserController::class)->parameters(['' => 'user']);

        Route::prefix('{user}')->group(function () {
            Route::post('avatar', [AvatarController::class, 'update']);
                
            Route::apiResource('movie-lists', MovieListController::class);

            Route::post('follow', [FollowController::class, 'store']);

            Route::delete('unfollow', [FollowController::class, 'destroy']);

            Route::get('followers', [FollowController::class, 'followers']);

            Route::get('following', [FollowController::class, 'following']);

            Route::apiResource('movie-lists', MovieListController::class);
            
            Route::get('watched', [WatchedController::class, 'index']);

            Route::get('watchLater', [WatchLaterController::class, 'index']);
        });
    });
});