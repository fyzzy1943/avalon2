<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class Sign extends Model
{
    protected $fillable = ['bit', 'date'];

    public function dayToBit($day)
    {
        return 1 << $day - 1;
    }
}
