<?php
/**
 * Created by zhang zhiyu.
 * Date: 2018/5/16 16:37
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download(Request $request)
    {
        $file = $request->input('file');
    }
}