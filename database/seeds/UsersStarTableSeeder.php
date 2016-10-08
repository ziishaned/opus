<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\WikiPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersStarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $users = User::pluck('id')->all();
        $pages = WikiPage::pluck('id')->all();
        $entityType = [
            'wiki',
            'page'
        ];

        for ($i = 0; $i < 50; $i++) {
            DB::table('user_star')->insert([
                'user_id'    => $faker->randomElement($users),
                'entity_id'  => $faker->randomElement($pages),
                'entity_type'=> $faker->randomElement($entityType),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
