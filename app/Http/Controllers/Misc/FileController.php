<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    //


    public function view($date, $name)
    {
//        var_dump($date, $name);


        $content = \Storage::get("orz/{$date}/{$name}");

//        $url = \Storage::url("orz/{$date}/{$name}");

//        dd($url);
//        return response($content);
//        dd($content);
    }
}
