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
}
