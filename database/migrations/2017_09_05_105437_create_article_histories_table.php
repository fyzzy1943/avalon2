<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_histories', function (Blueprint $table) {
            $table->unsignedInteger('id');
//            $table->timestamps();
            $table->timestamp('created_at');

            $table->unsignedInteger('uid');
            $table->unsignedInteger('cid');
            $table->string('title');
            $table->string('cover');
            $table->text('abstract');
            $table->text('doc_md');
            $table->text('doc_html');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_histories');
    }
}
