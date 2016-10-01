<?php

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name'      =>  $faker->userName,
                'email'     =>  $faker->email,
                'password'  =>  Hash::make($faker->password),
            ]);
        }
    }
}
