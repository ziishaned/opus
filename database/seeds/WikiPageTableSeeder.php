<?php

use Faker\Factory;
use App\Models\Wiki;
use App\Models\WikiPage;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class WikiPageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $users = User::pluck('id')->all();
        $wikis = Wiki::pluck('id')->all();
        $organizations = Organization::pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            WikiPage::create([
                'name'            =>  $faker->sentence(6, true),
                'description'     =>  $faker->paragraph(4, true),
                'user_id'         =>  $faker->randomElement($users),
                'wiki_id'         =>  $faker->randomElement($wikis),
                'organization_id' =>  $faker->randomElement($organizations),
            ]);
        }
    }
}
