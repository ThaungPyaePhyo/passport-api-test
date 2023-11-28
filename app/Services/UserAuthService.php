<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserAuthService
{
    public function login(array $input)
    {
        if (Auth::attempt($input)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return $token;
        }
    }
}
