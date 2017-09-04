<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    protected $fillable = ['bit', 'date'];

    public function dayToBit($day)
    {
        return 1 << $day - 1;
    }
}
