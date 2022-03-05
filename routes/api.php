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

// read comments
Route::get('/posts/{post}/comments', 'CommentController@index');

// read replies
Route::post('/comments/{comment}/replies', 'ReplyController@index');

Route::middleware(['apiauth'])->group(function () {
    // add, edit, delete comment
    Route::post('/posts/{post}/comments', 'CommentController@store');
    Route::put('/comments/{comment}', 'CommentController@update');
    Route::delete('/comments/{comment}', 'CommentController@destory');

    // add, edit, delete reply
    Route::post('/comments/{comment}/replies', 'ReplyController@store');
    Route::put('/replies/{reply}', 'ReplyController@update');
    Route::delete('/replies/{reply}', 'ReplyController@destory');

    // admin routes
    Route::middleware(['admin'])->group(function () {
        // posts
        Route::post('/posts', 'PostController@store');
        Route::put('/posts/{post}', 'PostController@update');
        Route::delete('/posts/{post}', 'PostController@destory');
    });
});

