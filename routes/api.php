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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('test', function() {
//    return App::version();
//});

Route::group(['namespace' => 'Api'], function () {

    Route::post('mercury', 'MercuryController@increase');
    Route::get('mercury', 'MercuryController@show');
    Route::get('download', 'FileController@download');

    Route::group(['prefix' => 'file'], function () {

        Route::get('rainy', 'FileController@rainy');
    });

    Route::apiResource('category', 'CategoryController');
});
//Route::post('mercury', '');
//
