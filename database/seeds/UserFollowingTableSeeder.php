<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFollowingTableSeeder extends Seeder
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

        for ($i = 0; $i < 20; $i++) {
            DB::insert('INSERT INTO user_following (following_id, user_id, created_at, updated_at) values (?, ?, ?, ?)', [
                $faker->randomElement($users),
                $faker->randomElement($users),
                Carbon::now(),
                Carbon::now(),
            ]);
        }
    }
}
