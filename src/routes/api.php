<?php

use App\Http\Controllers\Api\v1\AlbumController;
use App\Http\Controllers\Api\v1\AlbumPhotoController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\v1\PostCommentController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\TodoController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {    
    Route::prefix('v1')->group(function () {
        Route::get('user', UserController::class);

        Route::get('posts', [PostController::class, 'index']);
        Route::get('posts/{post}', [PostController::class, 'show']);
        
        Route::get('posts/{post}/comments', [PostCommentController::class, 'index']);
        Route::get('posts/{post}/comments/{comment}', [PostCommentController::class, 'show']);
        
        Route::get('albums', [AlbumController::class, 'index']);
        Route::get('albums/{album}', [AlbumController::class, 'show']);
        
        Route::get('albums/{album}/photos', [AlbumPhotoController::class, 'index']);
        Route::get('albums/{album}/photos/{photo}', [AlbumPhotoController::class, 'show']);
        
        Route::get('todos', TodoController::class);
    });
});
