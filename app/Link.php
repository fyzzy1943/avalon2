<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class Link extends Model
{
	protected $fillable = [
	    'name',
        'link',
        'introduction',
        'avatar',
    ];
}
