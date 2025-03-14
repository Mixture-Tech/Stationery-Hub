<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateDiscountPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cập nhật discount_price cho tất cả bản ghi trong bảng products
        DB::table('products')
            ->update([
                'discount_price' => DB::raw('price * (1 - discount / 100)'),
                'updated_at' => now(), // Cập nhật thời gian
            ]);
    }
}