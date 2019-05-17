<?php

namespace App\Http\Controllers\Avalon\Files;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PicsController extends Controller
{
    //

    public function create()
    {
        return view('avalon.pic.create');
    }


    public function view(Request $request, $date, $name)
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'pic' => 'required|file',
        ]);

        $file  = $request->file('pic');


        $path = $file->store('orz/' . Carbon::now()->format('Ym'), 'public');

        $url = config('app.url') . \Storage::url($path);

        $file = File::create([
            'url' => $url,
        ]);
//        dd($url);

        return redirect()->route('pic_list');
    }


    public function list(Request $request)
    {
        $list = File::orderByDesc('id')->get();

        return view('avalon.pic.list')->with('pics', $list);
    }
}
