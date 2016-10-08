<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(OrganizationTableSeeder::class);
         $this->call(UserOrganizationTableSeeder::class);
         $this->call(WikiTableSeeder::class);
         $this->call(WikiPageTableSeeder::class);
         $this->call(UserFollowerTableSeeder::class);
         $this->call(UsersWatchTableSeeder::class);
         $this->call(UsersStarTableSeeder::class);
    }
}
