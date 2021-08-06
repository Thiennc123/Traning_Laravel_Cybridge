<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'd_name' => 'Quan tri he thong',
            ],

            [
                'name' => 'dev',
                'd_name' => 'Developer',
            ],
            [
                'name' => 'user',
                'd_name' => 'User',
            ],
        ]);
    }
}
