<?php

namespace App\Http\Controllers\Avalon;

use App\Article;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
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

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

		return view('avalon.article.index')->with('articles', $articles);
    }

    public function create()
    {
        $categories = Category::all();

    	return view('avalon.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->doc_md = $request->input('editor-markdown-doc') ?? '';
        $article->doc_html = $request->input('editor-html-code') ?? '';
        $article->cover = $request->input('cover') ?? '';
        $article->abstract = $request->input('abstract') ?? '';
	    $article->status = $request->input('status');
        $article->cid = $request->input('category') ?? 0;


	    $article->uid = Auth::user()->id;

        $article->save();

		return redirect()->route('article');
    }

    public function edit($id)
    {
        $categories = Category::all();

        $article = Article::where('id', $id)->first();
        return view('avalon.article.edit')->with('article', $article)->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
		$article = Article::findOrFail($id);

	    $article->title = $request->input('title');
	    $article->doc_md = $request->input('editor-markdown-doc') ?? '';
	    $article->doc_html = $request->input('editor-html-code') ?? '';
        $article->cover = $request->input('cover') ?? '';
        $article->abstract = $request->input('abstract') ?? '';
	    $article->status = $request->input('status');
        $article->cid = $request->input('category');

	    $article->save();

	    return redirect()->route('article');
    }

    public function destroy($id)
    {
		$article = Article::findOrFail($id);

		$article->status = 2;
		$article->save();

		$result = $article->delete();

		if ($result) {
            return response()->json($id);
        }

		return response()->json(false);
    }

    public function recycle()
    {
        $articles = Article::onlyTrashed()->orderBy('created_at', 'desc')->get();

        return view('avalon.article.recycle')->with('articles', $articles);
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);

        $article->restore();

        return redirect()->route('article');
    }
}
