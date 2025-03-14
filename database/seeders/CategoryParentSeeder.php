<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_parents')->insert([
            [
                'id_parent' => 1,
                'name_parent' => 'Giấy văn phòng',
                'link' => 'giay-van-phong',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 2,
                'name_parent' => 'Các loại bút',
                'link' => 'cac-loai-but',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 3,
                'name_parent' => 'Các loại bìa',
                'link' => 'cac-loai-bia',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 4,
                'name_parent' => 'Văn phòng phẩm',
                'link' => 'van-phong-pham',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 5,
                'name_parent' => 'Đồ dùng học sinh',
                'link' => 'do-dung-hoc-sinh',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 6,
                'name_parent' => 'Nhu yếu phẩm',
                'link' => 'nhu-yeu-pham',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 7,
                'name_parent' => 'Thiết bị văn phòng',
                'link' => 'thiet-bi-van-phong',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
            [
                'id_parent' => 8,
                'name_parent' => 'Văn phòng phẩm cao cấp',
                'link' => 'vpp-cao-cap',
                'hide' => false,
                'created_at' => Carbon::parse('2025-03-01 16:07:35'),
                'updated_at' => Carbon::parse('2025-03-01 16:07:35'),
            ],
        ]);
    }
}
