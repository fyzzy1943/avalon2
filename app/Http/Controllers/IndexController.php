<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

	    foreach ( $articles as &$article ) {
		    $article->introduce = str_limit($article->doc_html, 300);
        }

    	return view('index')->with('articles', $articles);
    }

    public function show($id)
    {
//    	echo $id;
//	    $article = app('db')->table('article')->where('id', $id)->first();

//	    dd($article);

        $article = Article::where('id', $id)->first();

	    return view('detail')->with('article', $article);
    }

    //
}
