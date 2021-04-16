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
// Đăng ký
Route::post('/register', 'App\Http\Controllers\AuthController@register');
// Đăng nhập
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::group([],function() {
    /* **********
    **
    ** Thư mục 
    **
    ********** */
    Route::get('category', 'App\Http\Controllers\CategoryController@index');
    // Một thư mục
    Route::get('category/{category}', 'App\Http\Controllers\CategoryController@show');

});

Route::group(['middleware' => 'auth:api'], function () {
    // Đăng xuất
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

    /* **********
    **
    ** Thư mục 
    **
    ********** */
    Route::resource('/category', 'App\Http\Controllers\CategoryController')->except(['index', 'show']);
    // Sửa thư mục
    Route::post('/category/update/{category}', 'App\Http\Controllers\CategoryController@update');

});

