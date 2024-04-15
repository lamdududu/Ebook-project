<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NominationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten_de_cu' => 'Tác phẩm nổi bật'],
            ['ten_de_cu' => 'Tác phẩm được biên tập viên đề cử'],
            ['ten_de_cu' => 'Tác phẩm đã đoạt giải'],
        ];
        
        DB::table('nominations')->insert($data);
    }
}
