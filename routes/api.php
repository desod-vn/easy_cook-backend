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

Route::middleware('auth:api')->group(function(){
    // Đăng xuất
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

});
