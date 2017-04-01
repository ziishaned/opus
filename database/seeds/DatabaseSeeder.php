<?php

use Illuminate\Database\Seeder;
use Database\Seeds\Components\Integration\IntegrationActionsTableSeeder;
use Database\Seeds\Components\Notification\NotificationCategoryTableSeeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [
        IntegrationActionsTableSeeder::class,
        NotificationCategoryTableSeeder::class
    ];

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }
}