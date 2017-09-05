<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleHistory extends Model
{
    protected $fillable = [
        'id',
        'uid',
        'cid',
        'title',
        'cover',
        'abstract',
        'doc_md',
        'doc_html',
    ];

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;
}
