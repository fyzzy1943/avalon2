<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Link;
use App\Note;
use Carbon\Carbon;
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
    	// with 起到懒加载作用，可以以一条query执行
        $articles = Article::with('category')
            ->where('status', '1')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(5);
//	    $articles = Article::where('status', '1')->orderBy('created_at', 'desc')->simplePaginate(5);

        $links = Link::orderBy('id', 'desc')->get();

        $categories = Article::select('categories.id', 'categories.name')
                             ->leftJoin('categories', 'articles.cid', '=', 'categories.id')
                             ->distinct()
                             ->get();
    	return view('index', compact('articles', 'links', 'categories'));
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

	    return view('article')->with('article', $article);
    }

    /**
     * Show the about me page.
     */
    public function about()
    {

    }

	/**
	 * Show the category page.
	 *
	 * @param int|null $id
	 */
    public function category($id = null)
    {
	    $list = array();

	    if (is_null($id)) {
	    	// 所有分类

	        $articles = Article::select('articles.id', 'cid', 'title', 'articles.created_at', 'categories.name as category')
                ->join('categories', 'articles.cid', '=', 'categories.id')
                ->whereRaw('articles.status=1')
                ->orderByRaw('cid desc, articles.id desc')
                ->get();

		    foreach ( $articles->groupBy('cid') as &$article ) {
		        $tmp = array();
			    for ( $i = 0; $i < $article->count(); ++$i) {
				    if (! isset($tmp['name'])) {
				        $tmp['name'] = $article[$i]['category'];
				    }
				    if (! isset($tmp['count'])) {
					    $tmp['count'] = $article->count();
				    }
				    if (! isset($tmp['cid'])) {
					    $tmp['cid'] = $article[$i]['cid'];
				    }

				    $tmp['articles'][] = [
				        'id' => $article[$i]->id,
					    'title' => $article[$i]->title,
					    'created_at' => $article[$i]->created_at->format('M d, Y'),
				    ];

				    if ($i == 4) {
				        break;
				    }
		        }

		        $list[] = $tmp;
			    unset($tmp);
	        }
	    } else {
			// 具体分类页面

		    $category = Category::findOrFail($id);
		    $articles = Article::select('id', 'title', 'created_at')
                ->where([['cid', $id], ['status', 1]])
                ->orderBy('created_at', 'desc')
                ->get();

		    $list[] = [
		    	'cid' => $category->id,
			    'name' => $category->name,
			    'count' => $articles->count(),
			    'articles' => $articles->toArray(),
		    ];
	    }

	    return view('category', compact('list'));
    }

	/**
	 * Show archives page.
	 */
    public function archives()
    {
    	$articles = Article::orderBy('created_at', 'desc')
            ->where('status', 1)
            ->get();

    	$list = array();

    	foreach ($articles as $article) {
    		$list[$article->created_at->format('Ym')][] = $article;
	    }

		return view('archives', compact('list'));
    }

	/**
	 * Show the notes page.
	 */
    public function notes()
    {
		$notes = Note::orderBy('created_at', 'desc')->get();

		return view('notes', ['notes' => $notes]);
    }

    /*
     * Show the friends page.
     */
    public function friends()
    {
        $links = Link::orderBy('id', 'desc')->get();

        return view('friends')->with('links', $links);
    }
}
