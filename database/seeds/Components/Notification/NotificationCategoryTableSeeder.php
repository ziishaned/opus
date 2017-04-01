<?php

use Illuminate\Database\Seeder;
use Fenos\Notifynder\Models\NotificationCategory;

class NotificationCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationCategory::create([
		    'name' => 'wiki.updated',
		    'text' => '{extra.username} updated wiki {extra.wiki_name}.',
		]);

        NotificationCategory::create([
            'name' => 'wiki.deleted',
            'text' => '{extra.username} deleted wiki {extra.wiki_name}.',
        ]);

        NotificationCategory::create([
            'name' => 'page.created',
            'text' => '{extra.username} created page {extra.page_name} at wiki {extra.wiki_name}.',
        ]);

        NotificationCategory::create([
            'name' => 'page.updated',
            'text' => '{extra.username} updated page {extra.page_name} at wiki {extra.wiki_name}.',
        ]);

        NotificationCategory::create([
            'name' => 'page.deleted',
            'text' => '{extra.username} deleted page {extra.page_name} at wiki {extra.wiki_name}.',
        ]);

        NotificationCategory::create([
            'name' => 'wiki.user.mentioned',
            'text' => '{extra.username} mentioned you in a comment at wiki {extra.wiki_name}.',
        ]);

        NotificationCategory::create([
            'name' => 'page.user.mentioned',
            'text' => '{extra.username} mentioned you in a comment in page {extra.page_name} at wiki {extra.wiki_name}.',
        ]);
    }
}
