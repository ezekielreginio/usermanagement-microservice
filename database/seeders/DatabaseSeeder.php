<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_levels')->insert([
            [
                'access_level' => 'admin',
                'is_shown' => 1
            ],
            [
                'access_level' => 'manager',
                'is_shown' => 1
            ],
            [
                'access_level' => 'employee',
                'is_shown' => 1
            ],
            [
                'access_level' => 'client',
                'is_shown' => 1
            ],
        ]);
    }
}
