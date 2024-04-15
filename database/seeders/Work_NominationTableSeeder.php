<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Work_NominationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tac_pham' => '1',
                'de_cu' => '1'
            ],
            [
                'tac_pham' => '2',
                'de_cu' => '1'
            ],
            [
                'tac_pham' => '3',
                'de_cu' => '1'
            ],
            [
                'tac_pham' => '4',
                'de_cu' => '1'
            ],
            [
                'tac_pham' => '5',
                'de_cu' => '1'
            ],
            [
                'tac_pham' => '8',
                'de_cu' => '2'
            ],
            [
                'tac_pham' => '5',
                'de_cu' => '2'
            ],
            [
                'tac_pham' => '3',
                'de_cu' => '2'
            ],
            [
                'tac_pham' => '4',
                'de_cu' => '2'
            ],
            [
                'tac_pham' => '7',
                'de_cu' => '2'
            ],
            [
                'tac_pham' => '9',
                'de_cu' => '3'
            ],
            [
                'tac_pham' => '1',
                'de_cu' => '3'
            ],
            [
                'tac_pham' => '5',
                'de_cu' => '3'
            ],
            [
                'tac_pham' => '12',
                'de_cu' => '3'
            ],
            [
                'tac_pham' => '2',
                'de_cu' => '3'
            ],
        ];

        DB::table('works_nominations')->insert($data);
    }
}
