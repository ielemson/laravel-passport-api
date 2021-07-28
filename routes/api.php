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


Route::group(['prefix' => 'v1', 'middleware' => 'CORS'], function ($router) {

Route::get('/',function(){
return "Welcome To Laravel API";
});

Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::post('/forgot','ForgotController@forgot');
Route::post('/reset','ForgotController@reset'); 

Route::middleware('auth:api')->group(function () {

    Route::get('/user', 'AuthController@user');
    Route::post('/logout', 'AuthController@logout');

    Route::apiResource('products', 'ProductController');
    });

    // Rout::apiResource("/product","ProductController");

    });

