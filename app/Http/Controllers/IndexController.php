<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Link;
use App\Models\ArticleTag;
use App\Models\Tag;
use App\Note;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $articles = Article::with('category')
            ->with('tags')
            ->where('status', Article::STATUS_PUBLISHED)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(config('default.page_count', 10));

        $links = Link::orderBy('id', 'desc')->get();

        $categories = Article::select(['categories.id', 'categories.name'])
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

        if (Article::STATUS_PUBLISHED !== $article->status) {
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

            $articles = Article::select([
                'articles.id',
                'cid',
                'title',
                'articles.created_at',
                'categories.name as category',
            ])
                ->join('categories', 'articles.cid', '=', 'categories.id')
                ->where('articles.status', Article::STATUS_PUBLISHED)
                ->orderByRaw('cid desc, articles.id desc')
                ->get();

		    foreach ( $articles->groupBy('cid') as &$article ) {
		        $tmp = array();
			    for ( $i = 0; $i < count($article); ++$i) {
				    if (! isset($tmp['name'])) {
				        $tmp['name'] = $article[$i]['category'];
				    }
				    if (! isset($tmp['count'])) {
					    $tmp['count'] = count($article);
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
		    $articles = Article::select([
		        'id',
                'title',
                'created_at',
            ])
                ->where([
                    ['cid', $id],
                    ['status', Article::STATUS_PUBLISHED]
                ])
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
     * Show tags page.
     *
     * @param null|int $id
     */
    public function tags($name = null)
    {
        $tags = Tag::get();

        $articles = [];
        if (isset($name)) {
            $tag = Tag::where('name', $name)->first();

            if ($tag) {
                $articlesIds = ArticleTag::where('tag_id', $tag->id)->get();
                $articlesIdsArr = array_column($articlesIds->toArray(), 'article_id');
                $articles = Article::whereIn('id', $articlesIdsArr)
                    ->where('status', '1')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        return view('tags', compact('tags', 'articles'));
    }

	/**
	 * Show archives page.
	 */
    public function archives()
    {
    	$articles = Article::orderBy('created_at', 'desc')
            ->where('status', Article::STATUS_PUBLISHED)
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
        $links = Link::orderByRaw('RAND()')->limit(20)->get();

        return view('friends')->with('links', $links);
    }
}
