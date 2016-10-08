<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::pluck('id')->all();
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Organization::create([
                'name'    =>  $faker->company,
                'user_id' =>  $users[$i]
            ]);
        }
    }
}
