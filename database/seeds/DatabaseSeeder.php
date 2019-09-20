<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PerformanceLevelTableSeeder::class);
        $this->call(AgeClassTableSeeder::class);
        $this->call(PerformanceCategoryTableSeeder::class);
        $this->call(CostTableSeeder::class);
        $this->call(NationalCostTableSeeder::class);
    }
}
