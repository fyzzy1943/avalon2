<?php

namespace App\Http\Controllers\Avalon;

use App\Http\Requests\LinkRequest;
use App\Link;
use App\Sign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $currentTime = Carbon::now();

        $startOfMonth = $currentTime->startOfMonth()->toDateTimeString();

        $endOfMonth = $currentTime->endOfMonth()->toDateTimeString();

        echo $startOfMonth, '<br>';
        echo $endOfMonth;

        $signs = Sign::whereBetween('created_at', [
            $startOfMonth, $endOfMonth])
            ->get();

//        $signs = Sign::where('created_at', '>', $startOfMonth)
//            ->where('created_at', '<', $endOfMonth)
//            ->get();

//        $signs = Sign::where('created_at', '>', $startOfMonth->timestamp)
//            ->where(DB::raw("created_at < unix_timestamp('$endOfMonth')"))->get();

//        dd($signs->toArray());

        var_dump($signs->toArray());

        return view('avalon.system.sign');
    }

    /**
     * 签到
     */
    public function signCreate()
    {
        $sign = new Sign();

        $sign->uid = Auth::id();

        $sign->save();

        return redirect()->route('sign');
    }
}
