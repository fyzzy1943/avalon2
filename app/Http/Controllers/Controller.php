<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function formatJsonOutput($data = null, $code = 0, $msg = 'success')
    {
        $time = time();

        return response()->json([
            'code' => $code,
            'msg' => $msg,
            'time' => $time,
            'data' => $data,
        ]);
    }

    protected function formatFailureOutput($msg = 'failure', $code = 1, $data = null)
    {
        return $this->formatJsonOutput($data, $code, $msg);
    }
}
