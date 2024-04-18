<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AccountTypeTableSeeder::class);
        $this->call(AccountStatusTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(CopyrightProviderTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(WorkStatusTableSeeder::class);
        $this->call(WorkTableSeeder::class);
        $this->call(TimeTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(Work_CategoryTableSeeder::class);
        $this->call(NominationTableSeeder::class);
        $this->call(Work_NominationTableSeeder::class);
        $this->call(CartTableSeeder::class);
    }
}
