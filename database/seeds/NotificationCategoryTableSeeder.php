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
		    'text' => '
                <div class="pull-left event-icon" style="margin-right: 7px;">
                    <i class="fa fa-save fa-fw fa-lg icon"></i>
                </div>
                <div class="pull-left" style="position: relative; top: -3px; width: 89%;">
                    {extra.username} updated wiki {extra.wiki_name}.
                </div>
                <div class="clearfix"></div>
            ',
		]);

        NotificationCategory::create([
            'name' => 'wiki.deleted',
            'text' => '
                <div class="pull-left event-icon" style="margin-right: 7px;">
                    <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
                </div>
                <div class="pull-left" style="position: relative; top: -3px; width: 89%;">
                    {extra.username} deleted wiki {extra.wiki_name}.
                </div>
                <div class="clearfix"></div>
            ',
        ]);

        NotificationCategory::create([
            'name' => 'page.created',
            'text' => '
                <div class="pull-left event-icon" style="margin-right: 7px;">
                    <i class="fa fa-save fa-fw fa-lg icon"></i>
                </div>
                <div class="pull-left" style="position: relative; top: -3px; width: 89%;">
                    {extra.username} created page {extra.page_name} at wiki {extra.wiki_name}.
                </div>
                <div class="clearfix"></div>
            ',
        ]);

        NotificationCategory::create([
            'name' => 'page.updated',
            'text' => '
                <div class="pull-left event-icon" style="margin-right: 7px;">
                    <i class="fa fa-file-text-o fa-fw fa-lg icon"></i>
                </div>
                <div class="pull-left" style="position: relative; top: -3px; width: 89%;">
                    {extra.username} updated page {extra.page_name} at wiki {extra.wiki_name}.
                </div>
                <div class="clearfix"></div>
            ',
        ]);

        NotificationCategory::create([
            'name' => 'page.deleted',
            'text' => '
                <div class="pull-left event-icon" style="margin-right: 7px;">
                    <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
                </div>
                <div class="pull-left" style="position: relative; top: -3px; width: 89%;">
                    {extra.username} deleted page {extra.page_name} at wiki {extra.wiki_name}.
                </div>
                <div class="clearfix"></div>
            ',
        ]);
    }
}
