<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(OrganizationTableSeeder::class);
         $this->call(UserOrganizationTableSeeder::class);
         $this->call(WikiTableSeeder::class);
         $this->call(WikiPageTableSeeder::class);
    }
}
