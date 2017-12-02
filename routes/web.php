<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
//    return $app->version();
    return redirect('article');
});

Route::get('avalon', function() {
    return redirect('avalon/article');
});

Route::get('login', 'Avalon\LoginController@showLoginForm')->name('login');
Route::post('login', 'Avalon\LoginController@login');
Route::post('logout', 'Avalon\LoginController@logout')->name('logout');

//Route::get('register', 'Avalon\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Avalon\RegisterController@register');

Route::group([
    'prefix' => 'avalon',
    'middleware' => 'auth',
    'namespace' => 'Avalon'
], function () {

    // Article
    Route::get('article', 'ArticleController@index')->name('article');
    Route::get('article/create', 'ArticleController@create');
    Route::post('article', 'ArticleController@store');
    Route::get('article/{id}/edit', 'ArticleController@edit');
    Route::put('article/{id}', 'ArticleController@update');
    Route::delete('article/{id}', 'ArticleController@destroy');

    Route::get('article/recycle', 'ArticleController@recycle');
    Route::get('article/restore/{id}', 'ArticleController@restore');

    // Category
    Route::resource('category', 'CategoryController', [
        'except' => ['show'],
    ]);

    // Note
	Route::resource('note', 'NoteController');

    // System
	Route::group(['prefix' => 'system'], function () {
		Route::get('link', 'SystemController@links')->name('links');
		Route::post('link', 'SystemController@storeLink');
		Route::delete('link/{id}', 'SystemController@destroyLink');

		Route::get('sign/{year?}', 'SystemController@sign')->name('sign');
		Route::post('sign', 'SystemController@signCreate');
	});

    // Upload
    Route::post('upload/img/{name}', 'UploadController@img');
});

// ### WebSite ###

Route::get('article', 'IndexController@index');
Route::get('article/{id}', 'IndexController@show');

Route::get('category/{id?}', 'IndexController@category');

Route::get('archives', 'IndexController@archives');
Route::get('friends', 'IndexController@friends');
Route::get('notes', 'IndexController@notes');

Route::get('tags/{name?}', 'IndexController@tags');
