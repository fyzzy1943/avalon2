<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class NoteTag extends Model
{
    protected $fillable = ['name'];
}
