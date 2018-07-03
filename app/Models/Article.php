<?php

namespace App\Models;

use App\Events\ArticleSaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
	use softDeletes;
	use Notifiable;

	const STATUS_DRAFT = 0; // 草稿
	const STATUS_PUBLISHED = 1; // 已发布
	const STATUS_HIDDEN = 2; // 隐藏

    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'article_updated_at',
    ];

    protected $perPage = 10;

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
        return $this->belongsTo('App\Models\Category', 'cid', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }
}
