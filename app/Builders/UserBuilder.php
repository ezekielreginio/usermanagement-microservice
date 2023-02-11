<?php

namespace App\Builders;

use App\Models\Employee;
use App\Models\EmployeeToPosition;
use App\Models\Position;
use App\Models\User;
use App\Repositories\UsersRepository;

class UserBuilder 
{
    private User $user;
    private Employee $employee;
    private Position $position;
    private EmployeeToPosition $employeeToPosition;
    private UsersRepository $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**---------- BUILDER METHODS ----------*/

    public function createUser(array $userData, int $accessLevel)
    {
        $userData['password'] = app('hash')->make($userData['password']);
        $userData['fk_access_level'] = $accessLevel;
        $this->user = $this->repository->storeUser($userData);

        return $this;
    }
    
    public function createEmployee(array $employeeData, int $userId = null)
    {
        $employeeData['date_hired'] = $employeeData['date_hired'] ?? now();
        $employeeData['fk_user'] =  $userId ?? $this->user->id;
        $this->employee = $this->repository->storeEmployee($employeeData);

        return $this;
    }

    public function createPosition(string $position)
    {
        $this->position = $this->repository->getPositionByName($position);

        if ($this->position) {
            return $this;
        }
        
        $this->position = $this->repository->storePosition($position);

        return $this;
    }

    public function createEmployeePosition(int $employeeId = null, int $positionId = null)
    {
        $employeeId = $employeeId ?? $this->employee->id;
        $positionId = $positionId ?? $this->position->id;
        $this->employeeToPosition = $this->repository->storeEmployeeToPosition([
            "fk_employee" => $employeeId,
            "fk_position" => $positionId
        ]);
        return $this;
    }

    /**---------- GETTER METHODS ----------*/
    public function getUser()
    {
        return $this->user;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function getPosition()
    {
        return $this->position;
    }
}