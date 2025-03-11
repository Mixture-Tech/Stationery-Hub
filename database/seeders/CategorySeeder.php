<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert( [
            // Cate_parent id 1: Giấy văn phòng
            ['id_category' => 1, 'name_category' => 'Giấy A4', 'link' => 'giay-a4', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 2, 'name_category' => 'Giấy A3', 'link' => 'giay-a3', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 3, 'name_category' => 'Giấy A5', 'link' => 'giay-a5', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 4, 'name_category' => 'Giấy cuộn khổ lớn', 'link' => 'giay-cuon-kho-lon', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 5, 'name_category' => 'Giấy than', 'link' => 'giay-than', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 6, 'name_category' => 'Giấy note', 'link' => 'giay-note', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 7, 'name_category' => 'Giấy liên tục', 'link' => 'giay-lien-tuc', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 8, 'name_category' => 'Giấy in nhiệt', 'link' => 'giay-in-nhiet', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 9, 'name_category' => 'Giấy in ảnh', 'link' => 'giay-in-anh', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 10, 'name_category' => 'Giấy decal', 'link' => 'giay-decal', 'hide' => false, 'id_parent' => 1],
            ['id_category' => 11, 'name_category' => 'Giấy bìa cứng', 'link' => 'giay-bia-cung', 'hide' => false, 'id_parent' => 1],

            // Cate_parent id 2: Các loại bút
            ['id_category' => 12, 'name_category' => 'Bút bi', 'link' => 'but-bi', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 13, 'name_category' => 'Bút chì', 'link' => 'but-chi', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 14, 'name_category' => 'Bút xoá', 'link' => 'but-xoa', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 15, 'name_category' => 'Bút viết bảng', 'link' => 'but-viet-bang', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 16, 'name_category' => 'Bút lông dầu', 'link' => 'but-long-dau', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 17, 'name_category' => 'Bút gel', 'link' => 'but-gel', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 18, 'name_category' => 'Bút dạ quang', 'link' => 'but-da-quang', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 19, 'name_category' => 'Bút kim', 'link' => 'but-kim', 'hide' => false, 'id_parent' => 2],
            ['id_category' => 20, 'name_category' => 'Bút cao cấp', 'link' => 'but-cao-cap', 'hide' => false, 'id_parent' => 2],

            // Cate_parent id 3: Các loại bìa
            ['id_category' => 21, 'name_category' => 'Bìa còng', 'link' => 'bia-cong', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 22, 'name_category' => 'Bìa lá', 'link' => 'bia-la', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 23, 'name_category' => 'Bìa nhiều lá', 'link' => 'bia-nhieu-la', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 24, 'name_category' => 'Bìa trình kí', 'link' => 'bia-trinh-ki', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 25, 'name_category' => 'Bìa kiếng', 'link' => 'bia-kieng', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 26, 'name_category' => 'Bìa nút', 'link' => 'bia-nut', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 27, 'name_category' => 'Màng ép nhựa', 'link' => 'mang-ep-nhua', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 28, 'name_category' => 'Bìa hộp', 'link' => 'bia-hop', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 29, 'name_category' => 'Bìa quấn dây', 'link' => 'bia-quan-day', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 30, 'name_category' => 'Bìa phân trang', 'link' => 'bia-phan-trang', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 31, 'name_category' => 'Bìa kẹp', 'link' => 'bia-kep', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 32, 'name_category' => 'Bao thư', 'link' => 'bao-thu', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 33, 'name_category' => 'Bìa cây', 'link' => 'bia-cay', 'hide' => false, 'id_parent' => 3],
            ['id_category' => 34, 'name_category' => 'Bìa báo cáo', 'link' => 'bia-bao-cao', 'hide' => false, 'id_parent' => 3],

            ['id_category' => 35, 'name_category' => 'Kệ hồ sơ', 'link' => 'ke-ho-so', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 36, 'name_category' => 'Hộp cắm bút', 'link' => 'hop-cam-but', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 37, 'name_category' => 'Máy bấm kim', 'link' => 'may-bam-kim', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 38, 'name_category' => 'Kim bấm', 'link' => 'kim-bam', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 39, 'name_category' => 'Gỡ kim', 'link' => 'go-kim', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 40, 'name_category' => 'Dụng cụ đục lỗ', 'link' => 'dung-cu-duc-lo', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 56, 'name_category' => 'Thước các loại', 'link' => 'thuoc-cac-loai', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 57, 'name_category' => 'Băng keo', 'link' => 'bang-keo', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 58, 'name_category' => 'Kéo văn phòng', 'link' => 'keo-van-phong', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 59, 'name_category' => 'Dao rọc giấy', 'link' => 'dao-roc-giay', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 60, 'name_category' => 'Lưỡi dao rọc giấy', 'link' => 'luoi-dao-roc-giay', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 61, 'name_category' => 'Bàn cắt giấy', 'link' => 'ban-cat-giay', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 62, 'name_category' => 'Cắt keo', 'link' => 'cat-keo', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 76, 'name_category' => 'Hồ dán', 'link' => 'ho-dan', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 77, 'name_category' => 'Bao thẻ dây đeo', 'link' => 'bao-the-day-deo', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 78, 'name_category' => 'Sổ tay văn phòng', 'link' => 'so-tay-van-phong', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 79, 'name_category' => 'Mực dấu', 'link' => 'muc-dau', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 80, 'name_category' => 'Phiếu Hành chính Kế toán', 'link' => 'phieu-hanh-chinh-ke-toan', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 81, 'name_category' => 'Kẹp giấy kẹp bướm', 'link' => 'kep-giay-kep-buom', 'hide' => false, 'id_parent' => 4],
            ['id_category' => 82, 'name_category' => 'Gôm tẩy', 'link' => 'gom-tay', 'hide' => false, 'id_parent' => 4],

            // Cate_parent id 5: Đồ dùng học sinh
            ['id_category' => 41, 'name_category' => 'Hộp bút', 'link' => 'hop-but', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 42, 'name_category' => 'Máy tính cầm tay', 'link' => 'may-tinh-cam-tay', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 43, 'name_category' => 'Chuốt chì', 'link' => 'chuot-chi', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 44, 'name_category' => 'Ruột chì', 'link' => 'ruot-chi', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 45, 'name_category' => 'Chì sáp màu', 'link' => 'chi-sap-mau', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 63, 'name_category' => 'Bút học sinh', 'link' => 'but-hoc-sinh', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 64, 'name_category' => 'Thước Êke', 'link' => 'thuoc-eke', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 65, 'name_category' => 'Đất nặn', 'link' => 'dat-nan', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 66, 'name_category' => 'Tập vở', 'link' => 'tap-vo', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 67, 'name_category' => 'Dụng cụ vẽ', 'link' => 'dung-cu-ve', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 68, 'name_category' => 'Keo dán', 'link' => 'keo-dan', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 69, 'name_category' => 'Ba lô cặp sách', 'link' => 'ba-lo-cap-sach', 'hide' => false, 'id_parent' => 5],
            ['id_category' => 70, 'name_category' => 'Đồ chơi thể thao', 'link' => 'do-choi-the-thao', 'hide' => false, 'id_parent' => 5],

            // Cate_parent id 6: Nhu yếu phẩm
            ['id_category' => 46, 'name_category' => 'Đồ nhựa gia dụng', 'link' => 'do-nhua-gia-dung', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 47, 'name_category' => 'Bao xốp', 'link' => 'bao-xop', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 48, 'name_category' => 'Vật tư tiêu hao', 'link' => 'vat-tu-tieu-hao', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 49, 'name_category' => 'Thực phẩm văn phòng', 'link' => 'thuc-pham-van-phong', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 71, 'name_category' => 'Khăn giấy', 'link' => 'khan-giay', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 72, 'name_category' => 'Hóa phẩm', 'link' => 'hoa-pham', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 73, 'name_category' => 'Cây lau nhà', 'link' => 'cay-lau-nha', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 74, 'name_category' => 'Chổi các loại', 'link' => 'choi-cac-loai', 'hide' => false, 'id_parent' => 6],
            ['id_category' => 75, 'name_category' => 'Bao rác', 'link' => 'bao-rac', 'hide' => false, 'id_parent' => 6],

            // Cate_parent id 7: Thiết bị văn phòng
            ['id_category' => 50, 'name_category' => 'Mực in', 'link' => 'muc-in', 'hide' => false, 'id_parent' => 7],
            ['id_category' => 51, 'name_category' => 'Phụ kiện máy tính', 'link' => 'phu-kien-may-tinh', 'hide' => false, 'id_parent' => 7],
            ['id_category' => 52, 'name_category' => 'Pin các loại', 'link' => 'pin-cac-loai', 'hide' => false, 'id_parent' => 7],
            ['id_category' => 53, 'name_category' => 'Dịch vụ khắc dấu', 'link' => 'dich-vu-khac-dau', 'hide' => false, 'id_parent' => 7],
            ['id_category' => 54, 'name_category' => 'Ruy băng Film fax', 'link' => 'ruy-bang-film-fax', 'hide' => false, 'id_parent' => 7],
            ['id_category' => 55, 'name_category' => 'Bảng viết', 'link' => 'bang-viet', 'hide' => false, 'id_parent' => 7],
        ]);
    }
}
