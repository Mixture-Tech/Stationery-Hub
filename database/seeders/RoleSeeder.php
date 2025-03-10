<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id_role' => 1, 'name' => 'ADMIN'],
            ['id_role' => 2, 'name' => 'EMPLOYEE'],
            ['id_role' => 3, 'name' => 'USER'],
        ]);
    }
}
