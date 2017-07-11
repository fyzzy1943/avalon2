<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use softDeletes;

    public function category()
    {
        return $this->belongsTo('App\Category', 'cid');
    }

    public function getStatusDAttribute($value)
    {
        switch ($this->status) {
            case 0:
                $value = '草稿';
                break;
            case 1:
                $value = '已发布';
                break;
            case 2:
                $value = '隐藏';
                break;
        }

        return $value;
    }
}
