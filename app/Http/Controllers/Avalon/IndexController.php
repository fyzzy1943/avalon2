<?php

namespace App\Http\Controllers\Avalon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return redirect('avalon/article');
    }
}
