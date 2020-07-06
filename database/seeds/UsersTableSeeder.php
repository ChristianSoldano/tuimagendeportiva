<?php

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
         factory(App\User::class, 10)->create();

        App\User::create([
            'username' => 'siderjonas',
            'name' => 'Christian',
            'lastname' => 'Soldano',
            'email' => 'soldanochristian@hotmail.com',
            'password' => bcrypt('pastrana'),
            'permissions' => 'ADMIN'
        ]
        );
    }
}
