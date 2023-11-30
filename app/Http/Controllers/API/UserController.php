<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\ErrorCollection;
use App\Http\Resources\UserLoginCollection;
use App\Http\Resources\UserLogoutCollection;
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
        $user = $this->service->getUserInfo($token);
        if ($token && $user) {
            return new UserLoginCollection([
                'token' => collect($token),
                'user' => $user,
            ]);
        } else {
            return $this->sendError('Unauthorised.',['message' => 'Unauthorised']);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->token()->revoke();
            $data = [
                'success' => 1,
                'status' => 200,
                'data' => [
                    'message' => 'Logout Successfully.'
                ]
            ];
            return $data;
        }
    
    }
}
