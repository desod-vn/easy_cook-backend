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
    ** Chuyên mục 
    **
    ********** */
    // Xem tất cả
    Route::get('category', 'App\Http\Controllers\CategoryController@index');
    // Xem một
    Route::get('category/{category}', 'App\Http\Controllers\CategoryController@show');

    /* **********
    **
    ** Nguyên liệu 
    **
    ********** */
    // Xem tất cả
    Route::get('ingredient', 'App\Http\Controllers\IngredientController@index');
});

Route::group(['middleware' => 'auth:api'], function () {
    // Đăng xuất
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    // Thông tin
    Route::get('/info', 'App\Http\Controllers\AuthController@information');

    /* **********
    **
    ** Chuyên mục 
    **
    ********** */
    // Thêm
    Route::post('/category', 'App\Http\Controllers\CategoryController@store');
    // Xóa
    Route::delete('/category', 'App\Http\Controllers\CategoryController@delete');
    // Sửa
    Route::put('/category/{category}', 'App\Http\Controllers\CategoryController@update');

    /* **********
    **
    ** Nguyên liệu 
    **
    ********** */
    // Thêm
    Route::post('/ingredient', 'App\Http\Controllers\IngredientController@store');
    // Xóa
    Route::delete('/ingredient', 'App\Http\Controllers\IngredientController@delete');


});

