<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_levels')->insert([
            [
                'id' => 1,
                'access_level' => 'admin',
                'is_shown' => 1
            ],
            [
                'id' => 2,
                'access_level' => 'manager',
                'is_shown' => 1
            ],
            [
                'id' => 3,
                'access_level' => 'employee',
                'is_shown' => 1
            ],
            [
                'id' => 4,
                'access_level' => 'client',
                'is_shown' => 1
            ],
        ]);
    }
}
