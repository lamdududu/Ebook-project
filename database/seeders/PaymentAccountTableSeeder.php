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
                'ten_chu_so_huu' => 'Nguyễn Văn A',
                'mat_khau' => '123456',
                'tai_khoan' => '1',
            ],
            [
                'so_tai_khoan' => '1234567890',
                'ten_chu_so_huu' => 'Nguyễn Thị B',
                'mat_khau' => '123456',
                'tai_khoan' => '2',
            ],
            [
                'so_tai_khoan' => '2345678901',
                'ten_chu_so_huu' => 'Nguyễn Văn C',
                'mat_khau' => '123456',
                'tai_khoan' => '3',
            ],
            [
                'so_tai_khoan' => '3456789012',
                'ten_chu_so_huu' => 'Nguyễn Văn D',
                'mat_khau' => '123456',
                'tai_khoan' => '4',
            ],
            [
                'so_tai_khoan' => '4567890123',
                'ten_chu_so_huu' => 'Nguyễn Thị E',
                'mat_khau' => '123456',
                'tai_khoan' => '5',
            ],
            [
                'so_tai_khoan' => '5678901234',
                'ten_chu_so_huu' => 'Nguyễn Thị F',
                'mat_khau' => '123456',
                'tai_khoan' => '6',
            ],
        ];

        DB::table('payment_accounts')->insert($data);
    }
}
