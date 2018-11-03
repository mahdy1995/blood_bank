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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1' , 'namespace' => 'Api'], function(){
    Route::get('logs','MainController@logs');
    Route::get('governorates', 'MainController@governorates');
    Route::get('cities', 'MainController@cities');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('reset-password', 'AuthController@reset');
    Route::post('new-password', 'AuthController@password');

    Route::group(['middleware' => 'auth:api'], function (){
        Route::post('register-token', 'AuthController@registerToken');
        Route::post('remove-token', 'AuthController@removeToken');
        Route::get('blood-requests', 'MainController@bloodRequests');
        Route::get('articles', 'MainController@articles');
        Route::get('categories', 'MainController@categories');
        Route::post('blood-request/create', 'MainController@createRequest');
        Route::post('post-toggle-favourite','MainController@postFavourite');
        Route::get('my-favourites', 'MainController@myFavourites');
        Route::get('notifications-count', 'MainController@notificationsCount');
        Route::get('notifications', 'MainController@notifications');
        Route::get('settings', 'MainController@settings');
        Route::post('reports', 'MainController@reports');
    });
});
