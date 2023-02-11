<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeToPosition extends Model
{
    use SoftDeletes;

    protected $table = 'employees_to_positions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_employee',
        'fk_position'
    ];
}
