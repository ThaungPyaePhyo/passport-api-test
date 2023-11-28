<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this[0]->resource ?? '',
        ];
    }
}
