<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\Auth;

class UserAuthService
{
    public function login(array $input)
    {
        if (Auth::attempt($input)) {
            $user = Auth::user();
            $access_token = $user->createToken('')->accessToken;
            $expire_time = $user->createToken('')->token->expires_at;
            $format_expire_time = (new DateTime($expire_time))->format('Y-m-d H:i:s');

            $token = [
                'access_token' => $access_token,
                'expire_time' => $format_expire_time
            ];
            return $token;
        }
    }

    public function getUserInfo($token)
    {
        return Auth::user();
    }
}