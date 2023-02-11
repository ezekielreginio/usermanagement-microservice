<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegistrationRequest;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private UsersService $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    /**
     * Registers a client in the platform
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function register(ClientRegistrationRequest $request) 
    {
        return response()->json($this->service->registerClient($request->validated()));
    }
}
