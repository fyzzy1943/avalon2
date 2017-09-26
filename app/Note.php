<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class Note extends Model
{
    public function noteTags()
    {
    	return $this->belongsToMany('App\NoteTag', 'note_tag_note');
    }
}
