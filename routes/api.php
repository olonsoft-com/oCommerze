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
Route::group(['prefix' => 'v1', 'middleware' => ['web', 'auth']], function() {
	Route::get('/init', 'Api\v1\ApiController@init')->name('api.init');
});


/*
|--------------------------------------------------------------------------
| API Version 2 for Javascript Base Application
|--------------------------------------------------------------------------
|
| Here all the request from Application should maintain access token
*/
Route::group(['prefix' => 'v2'], function() {
	Route::get('/login', 'Api\v2\ApiController@login')->name('api.login');

	Route::middleware('auth:api', function(){
		Route::get('/init', 'Api\v2\ApiController@init')->name('api.index');
		Route::get('/init', 'Api\v2\ApiController@init')->name('api.index');
	});
	
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
