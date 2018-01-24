<?php

namespace App;

use App\Events\ArticleSaved;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * App\Article
 *
 * @property-read \App\Category $category
 * @property-read mixed $status_d
 * @property-read mixed $with_title
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Article onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Article withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int $uid
 * @property int $cid
 * @property string $title
 * @property string $cover
 * @property string $abstract
 * @property string $doc_md
 * @property string $doc_html
 * @property int $status 状态：0草稿1发布2隐藏
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDocHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDocMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 */
class Article extends Model
{
	use softDeletes;
	use Notifiable;

	const STATUS_DRAFT = 0;
	const STATUS_PUBLISHED = 1;
	const STATUS_HIDDEN = 2;

	protected $events = [
	    'saved' => ArticleSaved::class,
    ];

    public function getStatusDAttribute($value)
    {
        switch ($this->status) {
            case self::STATUS_DRAFT:
                $value = '草稿';
                break;
            case self::STATUS_PUBLISHED:
                $value = '已发布';
                break;
            case self::STATUS_HIDDEN:
                $value = '隐藏';
                break;
            default:
                $value = '未知';
                break;
        }

        return $value;
    }

    public function getWithTitleAttribute()
    {
    	return "# " . $this->title . "\n\n---\n\n" . $this->doc_md;
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'cid', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id');
    }
}
