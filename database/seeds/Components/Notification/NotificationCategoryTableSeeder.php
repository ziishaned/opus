<?php

namespace Database\Seeds\Components\Notification;

use Illuminate\Database\Seeder;
use Fenos\Notifynder\Models\NotificationCategory;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class NotificationCategoryTableSeeder extends Seeder
{
	/**
     * Path to notification_categories.json file.
     * 
     * @var string
     */
    private $notificationCategoriesFilePath = 'database/seeds/Components/Notification/notification_categories.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		$notificationCategories = $this->getNotificationCategories();
        
        foreach ($notificationCategories as $category) {
            NotificationCategory::create([
                'name' => $category['name'],
                'text' => $category['text']
            ]);
        } 	
    }

    /**
     * Get the notification categories from json file. 
     * 
     * @return array $notificationCategories
     */
    private function getNotificationCategories()
    {
        $notificationCategories = file_get_contents(base_path($this->notificationCategoriesFilePath));

        return json_decode($notificationCategories, true);
    }
}
