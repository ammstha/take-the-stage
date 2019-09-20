<?php

use App\Discount;
use Illuminate\Database\Seeder;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costs=[

            [
                'title' => 'Discount',
                'discount'=>2,
            ],

            [
                'title' => 'Event Cost',
                'discount'=>2,
            ],

            [
                'title' => 'Exceed Cost per person',
                'discount'=>2,
            ],

        ];
        foreach ($costs as $key=>$cost){
            Discount::create($cost);
        }
    }
}
