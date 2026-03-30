<?php

use App\Http\Controllers\Api\v1\AlbumController;
use App\Http\Controllers\Api\v1\AlbumPhotoController;
use App\Http\Controllers\Api\v1\PostCommentController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\TodoController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {    
    Route::get('/user', function (Request $request) {
        return response()->json(new UserResource($request->user()));
    });

	Route::prefix('v1')->group(function () {
        Route::apiResource('posts', PostController::class);
        Route::apiResource('posts.comments', PostCommentController::class)->only(['index', 'show']);
        Route::apiResource('albums', AlbumController::class);
        Route::apiResource('albums.photos', AlbumPhotoController::class)->only(['index', 'show']);
        Route::apiResource('todos', TodoController::class);
    });
});
