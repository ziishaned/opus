<?php

namespace Database\Seeds\Components\Page;

use Carbon\Carbon;
use App\Models\Page;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class PagesTableSeeder extends Seeder
{
    /**
     * Path to page.json file.
     *
     * @var string
     */
    private $pagesFilePath = 'database/seeds/Components/Page/pages.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = $this->getPages();

        foreach ($pages as $page) {
            Page::insert([
                'name'        => $page['name'],
                "lft"         => $page['lft'],
                "rgt"         => $page['rgt'],
                "depth"       => $page['depth'],
                'slug'        => str_slug($page['name'], '_'),
                'outline'     => $page['outline'],
                'description' => $page['description'],
                'position'    => $page['position'],
                'parent_id'   => $page['parent_id'],
                'user_id'     => $page['user_id'],
                'wiki_id'     => $page['wiki_id'],
                'team_id'     => $page['team_id'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }

    /**
     * Get the pages from json file.
     *
     * @return array $pages
     */
    private function getPages()
    {
        $pages = file_get_contents(base_path($this->pagesFilePath));

        return json_decode($pages, true);
    }
}
