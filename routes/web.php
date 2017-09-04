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

Route::get('/test', function () {
//	$client = new GuzzleHttp\Client();
//	$res = $client->request('GET', 'https://disqus.com/api/3.0/posts/list.json', [
//		'proxy' => '127.0.0.1:8080',
//		'query' => [
////			'access_token' => 'dfca03f123034c148c9d24eb0555d575',
//			'api_key' => 'QEH7lODEPmji7EPscIDbjeAxIBcqvzrpfeJuAlGqI3Rv1hEPgOa1q3GnZF7bKHBU',
////			'api_secret' => 'IjDXl5aqM0EnHYtuG2VBcdRzVLdiu6dr81emwZP67HtPdUWunTMGCkBL6cWD5Qxl',
//			'forum' => 'fordawn',
//		],
//	]);
//
//	dd(file_get_contents('php://temp'), $res, $res->getBody());

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => 'https://disqus.com/api/3.0/forums/listPosts.json?api_key=QEH7lODEPmji7EPscIDbjeAxIBcqvzrpfeJuAlGqI3Rv1hEPgOa1q3GnZF7bKHBU&forum=fordawn',
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_PROXY => '127.0.0.1:8888'
	]);

	$res = json_decode(curl_exec($curl));
	curl_close($curl);

	dd($res);
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

		Route::get('sign', 'SystemController@sign')->name('sign');
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

Route::get('notes', 'IndexController@notes');
