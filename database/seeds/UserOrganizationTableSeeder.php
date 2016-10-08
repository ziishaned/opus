<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserOrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $userType = [
            'normal',
            'admin'
        ];
        $users = User::pluck('id')->all();
        $organizations = Organization::pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            DB::table('user_organization')->insert([
                'user_id'         =>  $faker->randomElement($users),
                'user_type'       =>  $faker->randomElement($userType),
                'organization_id' =>  $faker->randomElement($organizations),
                'created_at'      =>  Carbon::now(),
                'updated_at'      =>  Carbon::now(),
            ]);
        }
    }
}
