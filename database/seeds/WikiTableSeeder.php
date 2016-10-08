<?php

use Faker\Factory;
use App\Models\Wiki;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class WikiTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $users = User::pluck('id')->all();
        $organizations = Organization::pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            Wiki::create([
                'name'            =>  $faker->sentence(2, true),
                'user_id'         =>  $faker->randomElement($users),
                'organization_id' =>  $faker->randomElement($organizations),
            ]);
        }
    }
}
