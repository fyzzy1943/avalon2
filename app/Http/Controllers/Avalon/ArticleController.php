<?php

namespace App\Http\Controllers\Avalon;

use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleTag;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    }

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

		return view('avalon.article.index')->with('articles', $articles);
    }

    public function create()
    {
        $categories = Category::all();

    	return view('avalon.article.create_vue', compact('categories'));
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->doc_md = $request->input('editor-markdown-doc') ?? '';
        $article->doc_html = $request->input('editor-html-code') ?? '';
        $article->cover = $request->input('cover') ?? '';
        $article->abstract = $request->input('abstract') ?? '';
        $article->cid = $request->input('category') ?? 0;
        $article->article_updated_at = Carbon::now();
	    $article->status = $request->input('status');

	    $article->uid = Auth::user()->id;

        $article->save();

        // 处理标签
        $tags = preg_split('/\s+/', $request->input('tags'), null, PREG_SPLIT_NO_EMPTY);

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tag->increment('count');

            ArticleTag::create([
                'article_id' => $article->id,
                'tag_id' => $tag->id,
            ]);
        }

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
        $article->article_updated_at = Carbon::now();

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
