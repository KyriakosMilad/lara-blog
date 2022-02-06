<?php

//use App\Tenant;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::domain(env("APP_URL") . ":8000")->group(function () {
//    Route::get("/", function()  {
//        dd("teeeeest");
//    });
//});
//
//Route::domain("{tenant}" . ":8000")->group(function () {
//    Route::get("test", function ($tenant) {
//        dd($tenant);
//    });
//});
//
//Route::get("/{tenant}", function ($tenant) {
//    Tenant::whereDomain($tenant)->firstOrFail()->config()->set();
//    dd(\App\User::all());
//});

Route::get("/", function () {
    return view("welcome");
});

Route::get("/blog", function () {
    return view("blog.home");
});

Route::get("/blog/post", function () {
    return view("blog.post");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix("/admin")->group(function () {
    Route::get("/", function () {
        return view("admin.home");
    });
});

