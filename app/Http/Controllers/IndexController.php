<?php

namespace App\Http\Controllers;

use App\Article;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the index page.
     *
     * @param Request $request
     */
    public function index()
    {
        $articles = Article::where('status', '1')->orderBy('created_at', 'desc')->simplePaginate(5);

        $links = Link::orderBy('id', 'desc')->get();

    	return view('index', compact('articles', 'links'));
    }

    /**
     * Show the article detail.
     *
     * @param $id
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        if (1 !== $article->status) {
            throw new NotFoundHttpException();
        }

	    return view('detail')->with('article', $article);
    }

    /**
     * Show the about me page.
     */
    public function about()
    {

    }
}
