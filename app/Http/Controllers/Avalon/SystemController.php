<?php

namespace App\Http\Controllers\Avalon;

use App\Http\Requests\LinkRequest;
use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function links()
    {
		$links = Link::orderBy('id', 'desc')->get();

		return view('avalon.system.links')->with('links', $links);
    }

    public function storeLink(LinkRequest $request)
    {
    	$link = new Link($request->all());

    	$link->save();

    	return redirect()->route('links');
    }

    public function destroyLink($id)
    {
    	$link = Link::findOrFail($id);

    	if ($link->delete()) {
		    return response()->json($id);
	    } else {
		    return response()->json(false);
	    }
    }
}
