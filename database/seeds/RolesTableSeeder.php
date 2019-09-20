<?php

use App\Role;
use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin               = new Role();
        $superAdmin->name         = 'super-admin';
        $superAdmin->description  = 'super-admin';
        $superAdmin->display_name = 'Super Administrator';
        $superAdmin->save();

        $studio               = new Role();
        $studio->name         = 'studio';
        $studio->description  = 'studio';
        $studio->display_name = 'studio';
        $studio->save();
    }
}
