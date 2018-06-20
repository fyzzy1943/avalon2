<?php
/**
 * Created by zhang zhiyu.
 * Date: 2018/6/20 14:45
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\TokenGuard;

class WebTokenGuard extends TokenGuard
{
    public function user()
    {
        $token = parent::user();

        if (!$token) {
            return null;
        }

        return $token->user;
    }
}
