<?php

namespace App\Http\Controllers\Avalon;

use App\Article;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;

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
        $article->doc_md = $request->input('editor-markdown-doc');
        $article->doc_html = $request->input('editor-html-code');
        $article->status = $request->input('status');
        $article->cover = $request->input('cover');
        $article->abstract = $request->input('abstract');
        $article->uid = Auth::user()->id;
        $article->cid = $request->input('category');

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
	    $article->doc_md = $request->input('editor-markdown-doc');
	    $article->doc_html = $request->input('editor-html-code');
        $article->status = $request->input('status');
        $article->cover = $request->input('cover');
        $article->abstract = $request->input('abstract');
        $article->cid = $request->input('category');

	    $article->save();

	    return redirect()->route('article');
    }

    public function destroy(Request $request)
    {
		$article = Article::find($request->input('id'));

		if ($article->trashed()) {
			return redirect('avalon/article');
		}

	    return redirect('avalon/article');
    }
}
