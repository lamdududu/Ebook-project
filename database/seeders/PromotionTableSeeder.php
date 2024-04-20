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
                'mo_ta_khuyen_mai' => '',
                'nguoi_tao' => '',
            ],
            [
                'ten_chuong_trinh' => '',
                'ngay_bat_dau' => '',
                'ngay_ket_thuc' => '',
                'ti_le_khuyen_mai' => '',
                'mo_ta_khuyen_mai' => '',
                'nguoi_tao' => '',
            ],
            [
                'ten_chuong_trinh' => '',
                'ngay_bat_dau' => '',
                'ngay_ket_thuc' => '',
                'ti_le_khuyen_mai' => '',
                'mo_ta_khuyen_mai' => '',
                'nguoi_tao' => '',
            ],
        ];

        // DB::table('promotions')->insert($data);
    }
}
