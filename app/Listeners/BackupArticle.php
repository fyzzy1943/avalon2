<?php

namespace App\Listeners;

use App\ArticleHistory;
use App\Events\ArticleSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class BackupArticle
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleSaved  $event
     * @return void
     */
    public function handle(ArticleSaved $event)
    {
        $article = $event->article;

        $articleHistory = new ArticleHistory($article->toArray());

        $articleHistory->created_at = $article->updated_at;

        $articleHistory->save();
    }
}
