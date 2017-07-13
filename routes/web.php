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

    // Category
    Route::resource('category', 'CategoryController', [
        'except' => ['show'],
    ]);

    // Upload
    Route::post('upload/img/{name}', 'UploadController@img');
});



Route::get('article', 'IndexController@index');
Route::get('article/{id}', 'IndexController@show');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
