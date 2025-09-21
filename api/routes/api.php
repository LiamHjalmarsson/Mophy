<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;

use App\Http\Controllers\Api\V1\Genre\GenreController;

use App\Http\Controllers\Api\V1\Comment\CommentController;
use App\Http\Controllers\Api\V1\Comment\CommentLikeController;

use App\Http\Controllers\Api\V1\Movie\FavoriteController;
use App\Http\Controllers\Api\V1\Movie\MovieController;
use App\Http\Controllers\Api\V1\Movie\LikeController as MovieLikeController;
use App\Http\Controllers\Api\V1\Movie\RatingController;
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
    Route::prefix('comments')->group(function () {
        Route::apiResource('/', CommentController::class)->parameters(['' => 'comment'])->only(['index', 'show']);
        
        Route::middleware('auth:sanctum')->group(function () { 
            Route::apiResource('/', CommentController::class)->parameters(['' => 'comment'])->only(['store', 'update', 'destroy']);
            
            Route::apiResource('{comment}/reaction', CommentLikeController::class)->only(['store', 'destroy']);
        });
    });
    
    Route::apiResource('genres', GenreController::class)->only(['index', 'show']);

    Route::middleware('auth:sanctum')->apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);


    Route::prefix('movies')->group(function () {
        Route::apiResource('/', MovieController::class)->parameters(['' => 'movie'])->only(['index', 'show']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::apiResource('/', MovieController::class)->parameters(['' => 'movie'])->only(['store','update','destroy']);
            
            Route::prefix('{movie}')->group(function() {
                Route::apiResource('reaction', MovieLikeController::class)->only(['store', 'destroy']);
    
                Route::apiResource('reviews', ReviewController::class);
                
                Route::apiResource('watched', WatchedController::class)->only(['store', 'destroy']);

                Route::apiResource('watch-later', WatchLaterController::class)->only(['store', 'destroy']);
                
                Route::apiResource('rating', RatingController::class)->only(['store', 'destroy']);

                Route::apiResource('favorite', FavoriteController::class)->only(['store', 'destroy']);
            });
        });
    });
    
    Route::prefix('users')->group(function () {
        Route::apiResource('/', UserController::class)->parameters(['' => 'user']);

        Route::prefix('{user}')->group(function () {
            Route::post('avatar', [AvatarController::class, 'update']);
                
            Route::apiResource('movie-lists', MovieListController::class);

            Route::get('favorite', [FavoriteController::class, 'index']);

            Route::post('follow', [FollowController::class, 'store']);

            Route::delete('unfollow', [FollowController::class, 'destroy']);

            Route::get('followers', [FollowController::class, 'followers']);

            Route::get('following', [FollowController::class, 'following']);

            Route::apiResource('movie-lists', MovieListController::class);
            
            Route::get('watched', [WatchedController::class, 'index']);

            Route::get('watch-later', [WatchLaterController::class, 'index']);
        });
    });
});