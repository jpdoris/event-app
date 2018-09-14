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

Route::namespace('Api/user')->group(function () {
    Route::post('/user/create', 'UserController@create');
    Route::post('/user/update', 'UserController@update');
    Route::get('/user/{username}', 'UserController@view');
});

Route::namespace('Api/event')->group(function () {
    Route::post('/event/create', 'EventController@create');
    Route::post('/event/update', 'EventController@update');
    Route::get('/event/{username}', 'EventController@view');
});

Route::namespace('Api')->group(function () {
    Route::get('/users', 'UserController@index');
    Route::get('/events', 'EventController@index');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
