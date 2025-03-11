<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['id_province' => 1, 'name' => 'Hà Nội', 'id_area' => 2],
            ['id_province' => 2, 'name' => 'Hồ Chí Minh', 'id_area' => 1],
            ['id_province' => 3, 'name' => 'Đà Nẵng', 'id_area' => 3],
            ['id_province' => 4, 'name' => 'Hải Phòng', 'id_area' => 2],
            ['id_province' => 5, 'name' => 'Cần Thơ', 'id_area' => 4],
            ['id_province' => 6, 'name' => 'An Giang', 'id_area' => 4],
            ['id_province' => 7, 'name' => 'Bà Rịa - Vũng Tàu', 'id_area' => 4],
            ['id_province' => 8, 'name' => 'Bắc Giang', 'id_area' => 2],
            ['id_province' => 9, 'name' => 'Bắc Kạn', 'id_area' => 2],
            ['id_province' => 10, 'name' => 'Bạc Liêu', 'id_area' => 4],
            ['id_province' => 11, 'name' => 'Bắc Ninh', 'id_area' => 2],
            ['id_province' => 12, 'name' => 'Bến Tre', 'id_area' => 4],
            ['id_province' => 13, 'name' => 'Bình Định', 'id_area' => 3],
            ['id_province' => 14, 'name' => 'Bình Dương', 'id_area' => 4],
            ['id_province' => 15, 'name' => 'Bình Phước', 'id_area' => 4],
            ['id_province' => 16, 'name' => 'Bình Thuận', 'id_area' => 3],
            ['id_province' => 17, 'name' => 'Cà Mau', 'id_area' => 4],
            ['id_province' => 18, 'name' => 'Cao Bằng', 'id_area' => 2],
            ['id_province' => 19, 'name' => 'Đắk Lắk', 'id_area' => 3],
            ['id_province' => 20, 'name' => 'Đắk Nông', 'id_area' => 3],
            ['id_province' => 21, 'name' => 'Điện Biên', 'id_area' => 2],
            ['id_province' => 22, 'name' => 'Đồng Nai', 'id_area' => 4],
            ['id_province' => 23, 'name' => 'Đồng Tháp', 'id_area' => 4],
            ['id_province' => 24, 'name' => 'Gia Lai', 'id_area' => 3],
            ['id_province' => 25, 'name' => 'Hà Giang', 'id_area' => 2],
            ['id_province' => 26, 'name' => 'Hà Nam', 'id_area' => 2],
            ['id_province' => 27, 'name' => 'Hà Tĩnh', 'id_area' => 3],
            ['id_province' => 28, 'name' => 'Hải Dương', 'id_area' => 2],
            ['id_province' => 29, 'name' => 'Hậu Giang', 'id_area' => 4],
            ['id_province' => 30, 'name' => 'Hòa Bình', 'id_area' => 2],
            ['id_province' => 31, 'name' => 'Hưng Yên', 'id_area' => 2],
            ['id_province' => 32, 'name' => 'Khánh Hòa', 'id_area' => 3],
            ['id_province' => 33, 'name' => 'Kiên Giang', 'id_area' => 4],
            ['id_province' => 34, 'name' => 'Kon Tum', 'id_area' => 3],
            ['id_province' => 35, 'name' => 'Lai Châu', 'id_area' => 2],
            ['id_province' => 36, 'name' => 'Lâm Đồng', 'id_area' => 3],
            ['id_province' => 37, 'name' => 'Lạng Sơn', 'id_area' => 2],
            ['id_province' => 38, 'name' => 'Lào Cai', 'id_area' => 2],
            ['id_province' => 39, 'name' => 'Long An', 'id_area' => 4],
            ['id_province' => 40, 'name' => 'Nam Định', 'id_area' => 2],
            ['id_province' => 41, 'name' => 'Nghệ An', 'id_area' => 3],
            ['id_province' => 42, 'name' => 'Ninh Bình', 'id_area' => 2],
            ['id_province' => 43, 'name' => 'Ninh Thuận', 'id_area' => 3],
            ['id_province' => 44, 'name' => 'Phú Thọ', 'id_area' => 2],
            ['id_province' => 45, 'name' => 'Quảng Bình', 'id_area' => 3],
            ['id_province' => 46, 'name' => 'Quảng Nam', 'id_area' => 3],
            ['id_province' => 47, 'name' => 'Quảng Ngãi', 'id_area' => 3],
            ['id_province' => 48, 'name' => 'Quảng Ninh', 'id_area' => 2],
            ['id_province' => 49, 'name' => 'Quảng Trị', 'id_area' => 3],
            ['id_province' => 50, 'name' => 'Sóc Trăng', 'id_area' => 4],
            ['id_province' => 51, 'name' => 'Sơn La', 'id_area' => 2],
            ['id_province' => 52, 'name' => 'Tây Ninh', 'id_area' => 4],
            ['id_province' => 53, 'name' => 'Thái Bình', 'id_area' => 2],
            ['id_province' => 54, 'name' => 'Thái Nguyên', 'id_area' => 2],
            ['id_province' => 55, 'name' => 'Thanh Hóa', 'id_area' => 3],
            ['id_province' => 56, 'name' => 'Thừa Thiên Huế', 'id_area' => 3],
            ['id_province' => 57, 'name' => 'Tiền Giang', 'id_area' => 4],
            ['id_province' => 58, 'name' => 'Trà Vinh', 'id_area' => 4],
            ['id_province' => 59, 'name' => 'Tuyên Quang', 'id_area' => 2],
            ['id_province' => 60, 'name' => 'Vĩnh Long', 'id_area' => 4],
            ['id_province' => 61, 'name' => 'Vĩnh Phúc', 'id_area' => 2],
            ['id_province' => 62, 'name' => 'Yên Bái', 'id_area' => 2],
            ['id_province' => 63, 'name' => 'Phú Yên', 'id_area' => 3],
        ]);
    }
}
