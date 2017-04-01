<?php

use App\Models\Page;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\IntegrationAction;
use Fenos\Notifynder\Models\NotificationCategory;
use Database\Seeds\Components\Page\PagesTableSeeder;
use Database\Seeds\Components\Permission\PermissionsTableSeeder;
use Database\Seeds\Components\Integration\IntegrationActionsTableSeeder;
use Database\Seeds\Components\Notification\NotificationCategoryTableSeeder;

class DatabaseSeeder extends Seeder
{
    private $seeders = [
        PagesTableSeeder::class,
        PermissionsTableSeeder::class,
        IntegrationActionsTableSeeder::class,
        NotificationCategoryTableSeeder::class,
    ];



    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $this->emptyModels();

        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }

    /**
     * Delete all rows from table before inserting new records.
     * 
     * @return void
     */
    private function emptyModels()
    {
        Page::getQuery()->delete();
        Permission::getQuery()->delete();
        IntegrationAction::getQuery()->delete();
        NotificationCategory::getQuery()->delete();
    }
}