<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\Client;
use App\Models\ClientToBusiness;
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

    public function storeBusiness($data)
    {
        return Business::create($data);
    }

    public function linkClientToBusiness(int $clientId, int $businessId)
    {
        return ClientToBusiness::create([
            "fk_client" => $clientId,
            "fk_business" => $businessId
        ]);
    }
}