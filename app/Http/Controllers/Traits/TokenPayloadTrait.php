<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;

trait TokenPayloadTrait
{
    private function setJWTPayload(User $user)
    {
        return [
            'user' => [
                'id' => $user->id,
                'fk_access_level' => $user->fk_access_level,
                'name' => $user->name
            ]
        ];
    }
}