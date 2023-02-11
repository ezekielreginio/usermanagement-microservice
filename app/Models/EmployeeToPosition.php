<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeToPosition extends Model
{
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

    /**
     * Establish the one on one relationship between employees_to_positions to positions table
     *
     * @return void
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'fk_position');
    }
}
