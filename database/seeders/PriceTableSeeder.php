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
                'gia_thanh' => '92000',
                'tac_pham'  => '1',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '78000',
                'tac_pham'  => '2',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '67000',
                'tac_pham'  => '3',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '103000',
                'tac_pham'  => '4',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '75000',
                'tac_pham'  => '5',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '78000',
                'tac_pham'  => '6',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '80000',
                'tac_pham'  => '7',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '57000',
                'tac_pham'  => '8',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '65000',
                'tac_pham'  => '9',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '92000',
                'tac_pham'  => '10',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '10000',
                'tac_pham'  => '11',
                'thoi_diem' => '1',
            ],
            [
                'gia_thanh' => '75000',
                'tac_pham'  => '12',
                'thoi_diem' => '1',
            ]
        ];

        DB::table('prices')->insert($data);
    }
}
