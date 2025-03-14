<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            ['id_area' => 1, 'name' => 'TP.HCM'],
            ['id_area' => 2, 'name' => 'Miền Bắc'],
            ['id_area' => 3, 'name' => 'Miền Trung'],
            ['id_area' => 4, 'name' => 'Miền Nam'],
        ]);
    }
}
