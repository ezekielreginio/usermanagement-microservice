<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\Client;
use App\Models\ClientToBusiness;
use App\Models\Employee;
use App\Models\EmployeeToPosition;
use App\Models\Position;
use App\Models\User;

class UsersRepository
{
    public function storeUser(array $data)
    {
        return User::create($data);
    }

    public function storeClient(array $data, int $clientId)
    {   
        $data['fk_user'] = $clientId;
        return Client::create($data);
    }

    public function storeBusiness(array $data)
    {
        return Business::create($data);
    }

    public function storeEmployee(array $data, int $userId = null)
    {
        $data['fk_user'] = $data['fk_user'] ?? $userId;
        return Employee::create($data);
    }

    public function storePosition(string $position)
    {
        return Position::create([ "name" => $position ]);
    }

    public function getPositionByName(string $position)
    {
        return Position::where(['name' => $position])->first();
    }

    public function storeEmployeeToPosition(array $data)
    {
        return EmployeeToPosition::create($data);
    }

    public function linkClientToBusiness(int $clientId, int $businessId)
    {
        return ClientToBusiness::create([
            "fk_client" => $clientId,
            "fk_business" => $businessId
        ]);
    }
}