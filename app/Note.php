<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function noteTags()
    {
    	return $this->belongsToMany('App\NoteTag', 'note_tag_note');
    }
}
