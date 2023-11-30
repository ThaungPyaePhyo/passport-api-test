<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserLoginCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'status' => 200,
            'token' => new AccessTokenResource($this['token']),
            'data' =>new UserLoginResource($this['user']),
        ];
    }
}
