<?php

namespace App\Http\Controllers\Traits;

use App\Http\Resources\UserResource;
use App\Models\User;

trait TokenPayloadTrait
{
    /**
     * Sets the JWT Public Claims
     *
     * @param User $user
     * @return array
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    private function setJWTPayload(User $user)
    {
        return [
            'user' => new UserResource($user)
        ];
    }
}