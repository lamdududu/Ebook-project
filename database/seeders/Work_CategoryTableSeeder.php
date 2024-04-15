<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Work_CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'tac_pham' => '1',
                'the_loai' => '6'
            ],
            [
                'tac_pham' => '2',
                'the_loai' => '1'
            ],
            [
                'tac_pham' => '2',
                'the_loai' => '3'
            ],
            [
                'tac_pham' => '2',
                'the_loai' => '9'
            ],
            [
                'tac_pham' => '3',
                'the_loai' => '1'
            ],
            [
                'tac_pham' => '4',
                'the_loai' => '2'
            ],
            [
                'tac_pham' => '4',
                'the_loai' => '6'
            ],
            [
                'tac_pham' => '5',
                'the_loai' => '7'
            ],
            [
                'tac_pham' => '6',
                'the_loai' => '4'
            ],
            [
                'tac_pham' => '7',
                'the_loai' => '6'
            ],
            [
                'tac_pham' => '8',
                'the_loai' => '1'
            ],
            [
                'tac_pham' => '8',
                'the_loai' => '3'
            ],
            [
                'tac_pham' => '8',
                'the_loai' => '9'
            ],
            [
                'tac_pham' => '9',
                'the_loai' => '1'
            ],
            [
                'tac_pham' => '10',
                'the_loai' => '2'
            ],
            [
                'tac_pham' => '10',
                'the_loai' => '6'
            ],
            [
                'tac_pham' => '11',
                'the_loai' => '7'
            ],
            [
                'tac_pham' => '12',
                'the_loai' => '4'
            ],
        ];

        DB::table('works_categories')->insert($data);
    }
}
