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

    /**
     * Constructor Method for UserBuilder
     *
     * @param UsersRepository $repository
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**---------- BUILDER METHODS ----------*/

    /**
     * Creates a user record
     *
     * @param array $userData
     * @param integer $accessLevel
     * 
     * @return UserBuilder
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function createUser(array $userData, int $accessLevel)
    {
        $userData['password'] = app('hash')->make($userData['password']);
        $userData['fk_access_level'] = $accessLevel;
        $this->user = $this->repository->storeUser($userData);

        return $this;
    }
    
    /**
     * Creates an employee record
     *
     * @param array $employeeData
     * @param integer|null $userId
     * @return UserBuilder
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function createEmployee(array $employeeData, int $userId = null)
    {
        $employeeData['date_hired'] = $employeeData['date_hired'] ?? now();
        $employeeData['fk_user'] =  $userId ?? $this->user->id;
        $this->employee = $this->repository->storeEmployee($employeeData);

        return $this;
    }

    /**
     * Creates a position record
     * Note: If the position exists, it will fetch the position ID
     *
     * @param string $position
     * @return UserBuilder
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function createPosition(string $position)
    {
        $this->position = $this->repository->getPositionByName($position);

        if ($this->position) {
            return $this;
        }
        
        $this->position = $this->repository->storePosition($position);

        return $this;
    }

    /**
     * Stores the Employee to Position Relationship
     *
     * @param integer|null $employeeId
     * @param integer|null $positionId
     * @return UserBuilder
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
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
    /**
     * Returns the User Model
     *
     * @return User
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Returns the Employee Model
     *
     * @return Employee
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Returns the Position Model
     *
     * @return Position
     * 
     * @author Ezekiel Reginio <ezekiel@1export.com>
     */
    public function getPosition()
    {
        return $this->position;
    }
}