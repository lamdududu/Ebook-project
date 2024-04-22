<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten_trang_thai_tp' => 'Đã đăng tải'],
            ['ten_trang_thai_tp' => 'Đã ẩn'],
            ['ten_trang_thai_tp' => 'Đang chờ phê duyệt'],
        ];

        DB::table('work_statuses')->insert($data);
    }
}
