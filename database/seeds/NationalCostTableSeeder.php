<?php

use App\NationalCost;
use Illuminate\Database\Seeder;

class NationalCostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $national_costs=[

            [
                'title' => '45 Day Rebate 5% off',
                'price'=>2,
                'slug'=> 'discount',
            ],
            [
                'title' => 'Cost per dancer received after 30 day deadline',
                'price'=>5,
                'slug'=>'regular',
            ],
            [
                'title' => 'Additional 2 Mins cost per/person',
                'price'=>3,
                'slug'=>'exceed',
            ],
            [
                'title' => 'Solo',
                'price'=>100,
                'slug'=> 'solo',
            ],
            [
                'title' => 'Duo/Trio',
                'price'=>55,
                'slug'=> 'duo-trio',
            ],
            [
                'title' => 'Small Group',
                'price'=>45,
                'slug'=> 'small-group',
            ],
            [
                'title' => 'Large Group',
                'price'=>45,
                'slug'=> 'large-group',
            ],
            [
                'title' => 'Line',
                'price'=>45,
                'slug'=> 'line',
            ],
        ];
        foreach ($national_costs as $key=>$national_cost){
            NationalCost::create($national_cost);
        }
    }
}
