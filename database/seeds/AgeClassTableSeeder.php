<?php

use App\AgeClass;
use Illuminate\Database\Seeder;

class AgeClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $age_classes=[
            [
                'classes' => 'Petite',
                'ages' => '5-8',

            ],
            [
                'classes' => 'Junior',
                'ages' => '9-12',

            ],
            [
                'classes' => 'Teen',
                'ages' => '13-15',

            ],
            [
                'classes' => 'Senior',
                'ages' => '16-24',

            ],
            [
                'classes' => 'Adult',
                'ages' => '25 and over',

            ],

        ];
        foreach ($age_classes as $key=>$age_class){
            AgeClass::create($age_class);
        }
    }
}
