<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ArticleHistory
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $created_at
 * @property int $uid
 * @property int $cid
 * @property string $title
 * @property string $cover
 * @property string $abstract
 * @property string $doc_md
 * @property string $doc_html
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereDocHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereDocMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleHistory whereUid($value)
 */
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
