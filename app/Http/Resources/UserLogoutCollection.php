<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserLogoutCollection extends ResourceCollection
{

    public function toArray(Request $request)
    {
        return [
            'id' => 1,
        ];
    }
}
