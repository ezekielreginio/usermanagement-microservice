<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientToBusiness extends Model
{
    use SoftDeletes;

    protected $table = 'clients_to_businesses';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_client',
        'fk_business'
    ];
}
