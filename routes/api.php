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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

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
    });

    });



    // Route::group(['prefix' => 'users', 'middleware' => 'CORS'], function ($router) {
    //     Route::post('/register', [UserController::class, 'register'])->name('register.user');
    //     Route::post('/login', [UserController::class, 'login'])->name('login.user');
    //     Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('profile.user');
    //     Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');
    //     });