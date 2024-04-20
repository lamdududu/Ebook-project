<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'so_tai_khoan' => '0123456789',
                'mat_khau' => '123456',
                'tai_khoan' => '3',
            ],
        ];

        DB::table('payment_accounts')->insert($data);
    }
}
