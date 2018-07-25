<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Note
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NoteTag[] $noteTags
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $doc_html
 * @property string $doc_md
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereDocHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereDocMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUpdatedAt($value)
 */
	class Note extends \Eloquent {}
}

namespace App{
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
	class ArticleHistory extends \Eloquent {}
}

namespace App{
/**
 * App\Link
 *
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @property string $link
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereUpdatedAt($value)
 * @property string $introduction 简介
 * @property string $avatar 头像
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Link whereIntroduction($value)
 */
	class Link extends \Eloquent {}
}

namespace App{
/**
 * App\NoteTag
 *
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NoteTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NoteTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NoteTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NoteTag whereUpdatedAt($value)
 */
	class NoteTag extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $nick
 * @property string|null $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MercuryStat
 *
 */
	class MercuryStat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Token
 *
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property string $token
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUserId($value)
 */
	class Token extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $count
 * @property \Carbon\Carbon|null $created_at
 * @property string $description
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticleTag
 *
 * @property int $article_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property int $tag_id
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereUpdatedAt($value)
 */
	class ArticleTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mercury
 *
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mercury whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mercury whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mercury whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mercury whereUserId($value)
 */
	class Mercury extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Article
 *
 * @property string $abstract
 * @property string $alias
 * @property \Carbon\Carbon $article_updated_at
 * @property int $cid
 * @property string $cover
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $deleted_at
 * @property string $doc_html
 * @property string $doc_md
 * @property int $id
 * @property int $page_views
 * @property int $status 状态：0草稿1发布2隐藏
 * @property string $title
 * @property int $uid
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read mixed $status_d
 * @property-read mixed $with_title
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereArticleUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDocHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDocMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePageViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article withoutTrashed()
 */
	class Article extends \Eloquent {}
}

namespace App{
/**
 * App\Sign
 *
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $uid
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sign whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sign whereUpdatedAt($value)
 */
	class Sign extends \Eloquent {}
}

