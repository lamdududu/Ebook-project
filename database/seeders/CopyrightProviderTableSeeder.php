<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopyrightProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'ten_nha_cung_cap' => 'Tsuki Lightnovel',
                'so_dien_thoai' => '0123456789',
                'email' => 'homebooks@azgroup.vn',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'ten_nha_cung_cap' => 'Công ty First News - Trí Việt',
                'so_dien_thoai' => '0123456789',
                'email' => 'rights@firstnews.com.vn',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'ten_nha_cung_cap' => 'Công ty Cổ phần Sách Thái Hà',
                'so_dien_thoai' => '0123456789',
                'email' => 'dichvuxuatban@thaihabooks.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'ten_nha_cung_cap' => 'Công ty Văn hóa & Truyền thông Nhã Nam',
                'so_dien_thoai' => '0123456789',
                'email' => 'info@nhanam.vn',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'ten_nha_cung_cap' => 'Công ty TNHH Văn hóa và Truyền thông Skybooks Việt Nam',
                'so_dien_thoai' => '0123456789',
                'email' => 'asbooks@azgroup.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'ten_nha_cung_cap' => 'Thuộc về tác giả',
                'so_dien_thoai' => '0123456789',
                'email' => 'xxx@gmail.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
        ];

        DB::table('copyright_providers')->insert($data);
    }
}
