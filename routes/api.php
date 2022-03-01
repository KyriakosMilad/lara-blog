<?php

use Illuminate\Http\Request;
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

// reading posts
Route::get('/posts', 'index@PostController');
Route::get('/posts/{id}', 'show@PostController');

Route::middleware(['apiauth', 'admin'])->group(function () {
    // control posts
    Route::post('/posts', 'store@PostController');
    Route::put('/posts/{id}', 'update@PostController');
    Route::delete('/posts/{id}', 'destory@PostController');
});

