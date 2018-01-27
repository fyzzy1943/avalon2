<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'description',
        'count',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
