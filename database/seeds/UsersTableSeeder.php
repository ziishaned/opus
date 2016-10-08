<?php

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run()
    {
        $faker = Factory::create();
        User::create([
            'name'      =>  'admin',
            'email'     =>  'admin@admin.com',
            'password'  =>  Hash::make('admin'),
        ]);

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name'      =>  $faker->userName,
                'email'     =>  $faker->email,
                'password'  =>  Hash::make($faker->password),
            ]);
        }
    }
}
