<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateDistrictFeeSeeder extends Seeder
{
    public function run()
    {
        DB::statement("
            UPDATE districts d
            JOIN provinces p ON d.id_province = p.id_province
            SET d.fee = 
                CASE 
                    WHEN p.id_area = 2 THEN 40000
                    WHEN p.id_area = 3 THEN 30000
                    WHEN p.id_area = 4 THEN 20000
                    WHEN p.id_area = 1 THEN 10000
                    ELSE d.fee
                END
        ");
    }
}
