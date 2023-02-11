<?php

namespace App\Services;

use App\Builders\UserBuilder;
use App\Http\Resources\UserResource;
use App\Repositories\UsersRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UsersService
{
    private UsersRepository $repository;
    private UserBuilder $builder;
    
    public function __construct(UsersRepository $repository, UserBuilder $builder)
    {
        $this->repository = $repository;
        $this->builder = $builder;
    }

    public function registerClient(array $data)
    {
        DB::beginTransaction();
        try {
            $userData = $data['user'];
            $userData['password'] = app('hash')->make($userData['password']);
            $userData['fk_access_level'] = 4;
            $user = $this->repository->storeUser($userData);

            $client = $this->repository->storeClient($data['client'], $user->id);
            if (isset($data['business']) && $data['business']) {
                $business = $this->repository->storeBusiness($data['business']);
                $this->repository->linkClientToBusiness($client->id, $business->id);
            }
            DB::commit();
            return [
                "data" => [
                    "user" => $user,
                    "client" => $client,
                    "business" => $business ?? []
                ],
                "message" => "User registered successfully"
            ];
        } catch(Exception $e) {
            DB::rollBack();

            return [
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ];
        }
    }

    public function createEmployee(array $data)
    {
        DB::beginTransaction();
        try {
            $employee = $this->builder
                             ->createUser($data['user'], 1)
                             ->createEmployee($data['employee'])
                             ->createPosition($data['employee']['position'])
                             ->createEmployeePosition();
            DB::commit();
            return [
                "data" => new UserResource($employee->getUser()),
                "message" => "Employee created successfully."
            ];
        } catch(Exception $e) {
            DB::rollBack();

            return [
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ];
        }
    }
}