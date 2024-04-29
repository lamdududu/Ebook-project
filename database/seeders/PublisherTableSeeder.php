<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nha_xuat_ban' => 'Nhà xuất bản Hội Nhà Văn',
                'so_dien_thoai' => '0123456789',
                'email' => 'hoinhavan@gmail.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Tổng Hợp Thành Phố Hồ Chí Minh',
                'so_dien_thoai' => '0123456789',
                'email' => 'thhcm@gmail.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Lao Động',
                'so_dien_thoai' => '0123456789',
                'email' => 'laodong@gmail.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Trẻ',
                'so_dien_thoai' => '0123456789',
                'email' => 'nxbtre@gmail.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Văn Học',
                'so_dien_thoai' => '0123456789',
                'email' => 'vanhoc@gmail.com',
                'dia_chi' => 'Số XXX, đường XXX, phường XXX, quận XXX, thành phố XXX, Việt Nam',
            ],
        ];
        
        DB::table('publishers')->insert($data);
    }
}
