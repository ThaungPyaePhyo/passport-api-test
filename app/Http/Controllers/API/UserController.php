<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\ErrorCollection;
use App\Http\Resources\UserLoginCollection;
use App\Models\User;
use App\Services\UserAuthService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(Protected UserAuthService $service) {
    }
    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(UserLoginRequest $request)
    {
        $input = $request->validated();
        $token = $this->service->login($input);
        if ($token) {
            return new UserLoginCollection(collect($token));
        } else {
            return $this->sendError('Unauthorised.',['error' => 'Unauthorised']);
        }
    }
}
