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
    public function sign($year = null)
    {
        // TODO: 检查$year

        $year = $year ?? date('Y');

        $startOfYear = "{$year}-01-01 00:00:00";
        $endOfYear = "{$year}-12-31 23:59:59";

        $signs = Sign::whereBetween('created_at', [$startOfYear, $endOfYear])->get();

        $list = array_fill_keys(range(1, 12), null);

        foreach ($list as $month => &$item) {
            $startOfMonth = strtotime("{$year}-{$month}-01");

            $item['values'] = array_fill(1, date('t', $startOfMonth), 0);
            $item['day_of_week'] = date('w', $startOfMonth);

            unset($value);
        }

        foreach ($signs as $sign) {
            $list[$sign->created_at->month]['values'][$sign->created_at->day] += 1;
        }

//        dd($list);

        return view('avalon.system.sign', compact('list'));
    }

    /**
     * 增加一次签到
     */
    public function signCreate()
    {
        $sign = new Sign();

        $sign->uid = Auth::id();

        $sign->save();

        return redirect()->route('sign');
    }
}
