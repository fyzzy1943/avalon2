<?php

namespace App\Http\Controllers\Avalon;

use App\Http\Requests\LinkRequest;
use App\Link;
use App\Sign;
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

    /**
     * 签到页面
     */
    public function sign()
    {
        return view('avalon.system.sign');
    }

    /**
     * 签到
     */
    public function signCreate()
    {
        $timestamp = time();
        $date = date('Ym', $timestamp);
        $sign = Sign::firstOrNew(['date' => $date]);
//        $sign = Sign::firstOrNew(['date' => $date], ['bit' => Sign::dayToBit(date('m', $timestamp))]);

//        $sign->save();

        return redirect()->route('sign');
    }
}
