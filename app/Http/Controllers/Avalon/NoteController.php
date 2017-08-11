<?php

namespace App\Http\Controllers\Avalon;

use App\Note;
use App\NoteTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//    	$notes = Note::with('noteTags')->orderBy('created_at', 'desc')->get();
	    $notes = Note::orderBy('created_at', 'desc')->get();

        return view('avalon.note.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$tags = preg_split('/\s+/', $request->input('tags'));

		var_dump($tags);

		var_dump(array_filter($tags, function ($v) {
			return ! $v === '';
		}));

		foreach (array_filter($tags, function ($v) {
			return ! $v === '';
		}) as $tag) {
			var_dump($tag);
//			if (empty($tag)) {
//				continue;
//			}
			$t = NoteTag::firstOrCreate(['name' => $tag]);
			var_dump($t->id);
		}


		dd(NoteTag::all()->toArray());

        $note = new Note;

        $note->doc_html = $request->input('editor-html-code') ?? '';
        $note->doc_md = $request->input('editor-markdown-doc') ?? '';

        $note->save();

        return redirect()->action('Avalon\NoteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
		return view('avalon.note.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$note = Note::findOrFail($id);

	    $note->doc_html = $request->input('editor-html-code') ?? '';
	    $note->doc_md = $request->input('editor-markdown-doc') ?? '';

	    $note->save();

	    return redirect()->route('note.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
