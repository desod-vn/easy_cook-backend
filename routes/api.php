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

    /* **********
    **
    ** Nguyên liệu 
    **
    ********** */
    // Xem tất cả
    Route::get('post', 'App\Http\Controllers\PostController@index');
    // Xem một
    Route::get('post/{post}', 'App\Http\Controllers\PostController@show');



});

Route::group(['middleware' => 'auth:api'], function () {
    // Đăng xuất
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    // Thông tin
    Route::get('/info', 'App\Http\Controllers\UserController@information');
    // Thay avatar
    Route::post('/avatar/{user}', 'App\Http\Controllers\UserController@avatar');
    // Kèm nguyên liệu
    Route::post('/ingredient_user/{user}', 'App\Http\Controllers\UserController@ingredient');
    // Gợi ý
    Route::get('/love/', 'App\Http\Controllers\UserController@get_love');
    // Lấy nguyên liệu
    Route::get('/ingredient_user/{user}', 'App\Http\Controllers\UserController@get_ingredient');
    // Xóa kèm nguyên liệu
    Route::delete('/ingredient_user/{user}', 'App\Http\Controllers\UserController@remove_ingredient');

    /* **********
    **
    ** Chuyên mục 
    **
    ********** */
    // Thêm
    Route::post('/category', 'App\Http\Controllers\CategoryController@store');
    // Xóa
    Route::delete('/category/{category}', 'App\Http\Controllers\CategoryController@destroy');
    // Sửa
    Route::put('/category/{category}', 'App\Http\Controllers\CategoryController@update');

    /* **********
    **
    ** Nguyên liệu 
    **
    ********** */
    // Thêm
    Route::post('/ingredient', 'App\Http\Controllers\IngredientController@store');
    // Sủa
    Route::put('/ingredient/{ingredient}', 'App\Http\Controllers\IngredientController@update');
    // Xem một
    Route::get('/ingredient/{ingredient}', 'App\Http\Controllers\IngredientController@show');
    // Score
    Route::get('/score/{ingredient}', 'App\Http\Controllers\IngredientController@score_ingredient');


    /* **********
    **
    ** Công thức
    **
    ********** */
    // Thêm
    Route::post('/post', 'App\Http\Controllers\PostController@store');
    // Xóa
    Route::delete('/post/{post}', 'App\Http\Controllers\PostController@destroy');
    // Sửa
    Route::post('/post/{post}', 'App\Http\Controllers\PostController@update');
    // Kèm nguyên liệu
    Route::post('/ingredient_post/{post}', 'App\Http\Controllers\PostController@ingredient');
    // Xóa kèm nguyên liệu
    Route::delete('/ingredient_post/{post}', 'App\Http\Controllers\PostController@remove_ingredient');

});

