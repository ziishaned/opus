<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use App\Models\UserOrganization;

class UserOrganizationTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $userType = [
            'normal',
            'admin'
        ];
        $users = User::pluck('id')->all();
        $organizations = Organization::pluck('id')->all();

        for ($i = 0; $i < 20; $i++) {
            UserOrganization::create([
                'user_id'         =>  $faker->randomElement($users),
                'user_type'       =>  $faker->randomElement($userType),
                'organization_id' =>  $faker->randomElement($organizations),
            ]);
        }
    }
}
