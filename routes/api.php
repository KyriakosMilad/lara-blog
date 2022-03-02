<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return "lara-blog";
});

// auth
Route::post('/register', 'register@AuthController');
Route::post('/login', 'login@AuthController');

// read posts
Route::get('/posts', 'index@PostController');
Route::get('/posts/{post}', 'show@PostController');

// read post comments
Route::get('/posts/{post}/comments', 'index@CommentController');

Route::middleware(['apiauth'])->group(function () {
    Route::post('/posts/{post}/comments', 'store@CommentController');
    Route::put('/posts/{post}/comments/{comment}', 'update@CommentController');
    Route::delete('/posts/{post}/comments/{comment}', 'destory@CommentController');

    // admin routes
    Route::middleware(['admin'])->group(function () {
        // posts
        Route::post('/posts', 'store@PostController');
        Route::put('/posts/{post}', 'update@PostController');
        Route::delete('/posts/{post}', 'destory@PostController');
    });
});

