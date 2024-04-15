<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten_the_loai' => 'Khoa học'],
            ['ten_the_loai' => 'Văn học'],
            ['ten_the_loai' => 'Kỹ năng sống'],
            ['ten_the_loai' => 'Thơ'],
            ['ten_the_loai' => 'Tản văn'],
            ['ten_the_loai' => 'Tiểu thuyết'],
            ['ten_the_loai' => 'Truyện ngắn'],
            ['ten_the_loai' => 'Văn học nước ngoài'],
            ['ten_the_loai' => 'Sức khỏe'],
        ];

        DB::table('categories')->insert($data);
    }
}