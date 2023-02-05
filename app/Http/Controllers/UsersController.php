<?php

namespace App\Http\Controllers;

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
     * @return 
     */
    public function register(Request $request) 
    {
        return response()->json($this->service->registerClient($request->all()));
    }
}
