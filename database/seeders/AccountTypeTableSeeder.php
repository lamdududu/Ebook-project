<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten_loai' => 'Quản trị viên'],
            ['ten_loai' => 'Biên tập viên'],
            ['ten_loai' => 'Người dùng'],
        ];

        DB::table('account_types')->insert($data);
    }
}
