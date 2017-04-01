<?php

use Illuminate\Database\Seeder;
use Database\Seeds\Components\Integration\IntegrationActionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $this->call(IntegrationActionsTableSeeder::class);
    }
}