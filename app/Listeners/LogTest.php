<?php

namespace App\Listeners;

use App\Events\ArticleSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogTest
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
     * @param  =ArticleSaved  $event
     * @return void
     */
    public function handle(ArticleSaved $event)
    {
        Log::info('backup_article_to_history', $event->article->toArray());
    }
}
