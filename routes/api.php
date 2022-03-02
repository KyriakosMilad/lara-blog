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
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

// read posts
Route::get('/posts', 'PostController@index');
Route::get('/posts/{post}', 'PostController@show');

// read post comments
Route::get('/posts/{post}/comments', 'CommentController@index');

Route::middleware(['apiauth'])->group(function () {
    Route::post('/posts/{post}/comments', 'CommentController@store');
    Route::put('/posts/{post}/comments/{comment}', 'CommentController@update');
    Route::delete('/posts/{post}/comments/{comment}', 'CommentController@destory');

    // admin routes
    Route::middleware(['admin'])->group(function () {
        // posts
        Route::post('/posts', 'PostController@store');
        Route::put('/posts/{post}', 'PostController@update');
        Route::delete('/posts/{post}', 'PostController@destory');
    });
});

