<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(AreaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategoryParentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(UpdateDistrictFeeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UpdateDiscountPriceSeeder::class);



        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
