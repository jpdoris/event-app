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

Route::namespace('Api')->group(function () {
    Route::post('/user/create', 'UserController@create');
    Route::post('/user/update', 'UserController@update');
    Route::get('/user/{username}', 'UserController@view');
    Route::get('/users', 'UserController@index');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
