<?php

namespace App\Http\Controllers\Traits;

use App\Http\Resources\UserResource;
use App\Models\User;

trait TokenPayloadTrait
{
    private function setJWTPayload(User $user)
    {
        return [
            'user' => new UserResource($user)
        ];
    }
}