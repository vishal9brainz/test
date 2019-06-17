<?php

use Illuminate\Http\Request;

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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::post('forget-password','Api\ForgotPasswordController@sendEmail');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('logout', 'Api\UserController@logout');
	Route::get('profile', 'Api\UserController@getAuthUser');
	Route::post('update_profile', 'Api\UserController@updateProfile');
    Route::resource('rides','Api\RideController');
});
 Route::get('rides_list','Api\ListController@getList');
 Route::post('findRoute','Api\ListController@findRoute');
