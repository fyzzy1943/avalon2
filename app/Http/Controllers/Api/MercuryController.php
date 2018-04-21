<?php

namespace App\Http\Controllers\Api;

use App\Models\Mercury;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MercuryController extends Controller
{
    public function increase(Request $request)
    {
        Mercury::create();

        return $this->formatJsonOutput();
    }
}
