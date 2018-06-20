<?php
/**
 * Created by zhang zhiyu.
 * Date: 2018/6/20 15:22
 */

if (!function_exists('generate_token')) {

    /**
     *
     */
    function generate_token() {
        $token = str_random(32);
        $userId = Auth::id();

        \App\Models\Token::create([
            'user_id' => $userId,
            'token' => $token,
        ]);

        return $token;
    }
}
