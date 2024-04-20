<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'ten_chuong_trinh' => 'Khuyến Mãi Mừng Xuân',
                'ngay_bat_dau' => '2024-02-08',
                'ngay_ket_thuc' => '2024-02-20',
                'mo_ta_khuyen_mai' => 'Khai xuân giảm đến 70% toàn bộ sách điện tử khi mua trong thời gian khuyến mãi.',
                'nguoi_tao' => '1',
            ],
            [
                'ten_chuong_trinh' => 'Tuần Lễ Sách Khoa Học',
                'ngay_bat_dau' => '2024-04-15',
                'ngay_ket_thuc' => '2024-04-21',
                'mo_ta_khuyen_mai' => 'Giảm đến 60% toàn bộ sách điện tử thể loại khoa học trong thời gian diễn ra tuần lễ sách khoa học.',
                'nguoi_tao' => '1',
            ],
            [
                'ten_chuong_trinh' => 'Khuyến Mãi Chào Hè 2024',
                'ngay_bat_dau' => '2024-04-20',
                'ngay_ket_thuc' => '2024-05-10',
                'mo_ta_khuyen_mai' => 'Khuyến mãi đầu hè lên đến 40% cho toàn bộ sách điện tử của E-read',
                'nguoi_tao' => '1',
            ],
            [
                'ten_chuong_trinh' => 'Khuyến Mãi Đại Lễ 30/4 - 01/05',
                'ngay_bat_dau' => '2024-04-20',
                'ngay_ket_thuc' => '2024-05-05',
                'mo_ta_khuyen_mai' => 'Chào mừng ngày Giải phóng miền Nam, thống nhất đất nước và Quốc tế Lao Động, giảm đến 50% cho một số sách điện tử có trong chương trình.',
                'nguoi_tao' => '1',
            ],
            [
                'ten_chuong_trinh' => 'Khuyến Mãi Quốc Tế Thiếu Nhi ',
                'ngay_bat_dau' => '2024-05-27',
                'ngay_ket_thuc' => '2024-06-03',
                'mo_ta_khuyen_mai' => 'Chào mừng Quốc tế Thiếu Nhi, giảm giá toàn bộ sách điện tử thể loại giáo dục và thiếu nhi đến 50%.',
                'nguoi_tao' => '1',
            ],
        ];

        DB::table('promotions')->insert($data);
    }
}
