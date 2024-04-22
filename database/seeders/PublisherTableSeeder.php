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
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Tổng Hợp Thành Phố Hồ Chí Minh',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Lao Động',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Trẻ',
            ],
            [
                'nha_xuat_ban' => 'Nhà xuất bản Văn Học',
            ],
        ];
        
        DB::table('publishers')->insert($data);
    }
}
