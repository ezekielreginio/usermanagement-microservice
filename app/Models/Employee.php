<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_user',
        'date_hired',
        'sss_id',
        'tin_id',
        'pagibig_id',
        'philhealth_id',
        'birthdate'
    ];
}
