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
    /**
     * Stores user record in DB
     *
     * @param array $data
     * @return User
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function storeUser(array $data)
    {
        return User::create($data);
    }

    /**
     * Stores client data in DB
     *
     * @param array $data
     * @param integer $clientId
     * @return Client
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function storeClient(array $data, int $clientId)
    {   
        $data['fk_user'] = $clientId;
        return Client::create($data);
    }

    /**
     * Stores business data in DB
     *
     * @param array $data
     * @return Business
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function storeBusiness(array $data)
    {
        return Business::create($data);
    }

    /**
     * Stores employee record in DB
     *
     * @param array $data
     * @param integer|null $userId
     * @return Employee
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function storeEmployee(array $data, int $userId = null)
    {
        $data['fk_user'] = $data['fk_user'] ?? $userId;
        return Employee::create($data);
    }

    /**
     * Stores position record in DB
     *
     * @param string $position
     * @return Position
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function storePosition(string $position)
    {
        return Position::create([ "name" => $position ]);
    }

    /**
     * Fetch Position record by name
     *
     * @param string $position
     * @return Position
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function getPositionByName(string $position)
    {
        return Position::where(['name' => $position])->first();
    }

    /**
     * Stores transactional record of employee position in DB
     *
     * @param array $data
     * @return EmployeeToPosition
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function storeEmployeeToPosition(array $data)
    {
        return EmployeeToPosition::create($data);
    }

    /**
     * Stores transactional record of client to business in DB
     *
     * @param integer $clientId
     * @param integer $businessId
     * @return ClientToBusiness
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function linkClientToBusiness(int $clientId, int $businessId)
    {
        return ClientToBusiness::create([
            "fk_client" => $clientId,
            "fk_business" => $businessId
        ]);
    }
}