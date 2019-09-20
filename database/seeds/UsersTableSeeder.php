<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin     = User::create([
            'name'     => 'Amrit',
            'email'    => 'amritshrestha@gmail.com',
            'password' => bcrypt('123456'),
            'studioX' => 1,
            'approved_at' => now(),
            'ip'=>'127.0.0.1',
        ]);
        $superAdminRole = Role::whereName('super-admin')->first();
        $superAdmin->attachRole($superAdminRole);

        $studio     = User::create([
            'name'     => 'studio',
            'email'    => 'studio@gmail.com',
            'password' => bcrypt('123456'),
            'studioX' => 1,
            'approved_at' => now(),
            'ip'=>'127.0.0.1',
        ]);
        $studioRole = Role::whereName('studio')->first();
        $studio->attachRole($studioRole);
        $studio->studio()->create([
//            'director_name'=>'director',
        ]);
    }
}
