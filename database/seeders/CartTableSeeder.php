<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tai_khoan' => '3',
                'tac_pham' => '1',
            ],
            [
                'tai_khoan' => '3',
                'tac_pham' => '5',
            ],
            [
                'tai_khoan' => '9',
                'tac_pham' => '2',
            ],
            [
                'tai_khoan' => '9',
                'tac_pham' => '5',
            ],
            [
                'tai_khoan' => '9',
                'tac_pham' => '7',
            ],
            [
                'tai_khoan' => '3',
                'tac_pham' => '8',
            ],
        ];

        DB::table('carts')->insert($data);
    }
}
