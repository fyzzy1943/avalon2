<?php
/**
 * Created by zhang zhiyu.
 * Date: 2018/5/16 16:37
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Qiniu\Auth;

class FileController extends Controller
{
    public function download(Request $request)
    {
        $file = $request->input('file');
    }

    public function rainy(Request $request)
    {
        $auth = new Auth(
            config('app.qiniu_access_key'),
            config('app.qiniu_secret_key')
        );

        $baseUrl = 'https://static.fordawn.com/rainy/0.m4a';

        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);

        return $this->formatJsonOutput([
            'url' => $signedUrl,
        ]);
    }
}