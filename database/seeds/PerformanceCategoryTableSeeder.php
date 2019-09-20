<?php

use App\PerformanceCategory;
use Illuminate\Database\Seeder;

class PerformanceCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performance_categories=[

            [
                'name' => 'Acrobat',
            ],
            [
                'name' => 'Ballet',
            ],
            [
                'name' => 'Character/Musical Theater',
            ],
            [
                'name' => 'Clogging',
            ],
            [
                'name' => 'Drill/Pom',
            ],
            [
                'name' => 'Hip-Hop',
            ],
            [
                'name' => 'Jazz',
            ],
            [
                'name' => 'Liturgical',
            ],
            [
                'name' => 'Lyrical',
            ],
            [
                'name' => 'Modern',
            ],
            [
                'name' => 'Open',
            ],
            [
                'name' => 'Pointe',
            ],
            [
                'name' => 'Tap',
            ],
            [
                'name' => 'Others',
            ],

        ];
        foreach ($performance_categories as $key=>$performance_category){
            PerformanceCategory::create($performance_category);
        }
    }
}
