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

        $count = Mercury::count();

        return $this->formatJsonOutput($count);
    }

    public function show(Request $request)
    {
        $mercury = Mercury::all();

        return $this->formatJsonOutput([
            'count' => $mercury->count(),
            'list' => $mercury,
        ]);
    }
}
