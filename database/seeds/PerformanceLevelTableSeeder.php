<?php

use App\PerformanceLevel;
use Illuminate\Database\Seeder;

class PerformanceLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performance_levels=[

            [
                'name' => 'Amateur',
            ],
            [
                'name' => 'Competitive',
            ],
            [
                'name' => 'Elite',
            ],
            [
                'name' => 'Pro-Am',
            ],
        ];
        foreach ($performance_levels as $key=>$performance_level){
            PerformanceLevel::create($performance_level);
        }
    }
}
