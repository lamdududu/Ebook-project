<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'gia_ban_thuong' => '92000',
                'giac_ban_db' => '110000',
                'tac_pham'  => '1',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '78000',
                'giac_ban_db' => '90000',
                'tac_pham'  => '2',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '67000',
                'giac_ban_db' => '82000',
                'tac_pham'  => '3',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '103000',
                'giac_ban_db' => '130000',
                'tac_pham'  => '4',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '75000',
                'giac_ban_db' => '93000',
                'tac_pham'  => '5',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '78000',
                'giac_ban_db' => '100000',
                'giac_ban_db' => '',
                'tac_pham'  => '6',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '80000',
                'giac_ban_db' => '103000',
                'tac_pham'  => '7',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '57000',
                'giac_ban_db' => '74000',
                'tac_pham'  => '8',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '65000',
                'giac_ban_db' => '91000',
                'tac_pham'  => '9',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '92000',
                'giac_ban_db' => '116000',
                'tac_pham'  => '10',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '80000',
                'giac_ban_db' => '97000',
                'tac_pham'  => '11',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '75000',
                'giac_ban_db' => '90000',
                'tac_pham'  => '12',
                'thoi_diem' => '1',
            ],
            [
                'gia_ban_thuong' => '70000',
                'giac_ban_db' => '90000',
                'tac_pham'  => '3',
                'thoi_diem' => '2',
            ],
            [
                'gia_ban_thuong' => '75000',
                'giac_ban_db' => '92000',
                'tac_pham'  => '11',
                'thoi_diem' => '2',
            ],
            [
                'gia_ban_thuong' => '82000',
                'giac_ban_db' => '92000',
                'tac_pham'  => '7',
                'thoi_diem' => '2',
            ],
            [
                'gia_ban_thuong' => '98000',
                'giac_ban_db' => '125000',
                'tac_pham'  => '4',
                'thoi_diem' => '2',
            ]
            
        ];

        DB::table('prices')->insert($data);
    }
}
