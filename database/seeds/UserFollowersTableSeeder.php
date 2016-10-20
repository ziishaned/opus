<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFollowerTableSeeder extends Seeder
{
    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @param User $user App\Models\User
     */
    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = $this->user->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            DB::table('user_followers')->insert([
                'user_id'      => $faker->randomElement($users),
                'follow_id'    => $faker->randomElement($users),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }
    }
}
