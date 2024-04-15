<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten_trang_thai' => 'Đang hoạt động'],
            ['ten_trang_thai' => 'Đã bị khóa'],
        ];

        DB::table('account_statuses')->insert($data);
    }
}
