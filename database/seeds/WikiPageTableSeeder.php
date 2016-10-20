<?php

use Faker\Factory;
use App\Models\Wiki;
use App\Models\User;
use App\Models\WikiPage;
use Illuminate\Database\Seeder;

class WikiPageTableSeeder extends Seeder
{
    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @var App\Models\Wiki
     */
    protected $wiki;

    /**
     * @var App\Models\WikiPage
     */
    protected $wikiPage;

    /**
     * @param User         $user         App\Models\User
     * @param Wiki         $wiki         App\Models\Wiki
     * @param WikiPage     $wikiPage     App\Models\WikiPage
     */
    public function __construct(User $user, Wiki $wiki, WikiPage $wikiPage) {
        $this->user         = $user;
        $this->wiki         = $wiki;
        $this->wikiPage     = $wikiPage;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          =  Factory::create();
        $users          =  $this->user->pluck('id')->all();
        $wikis          =  $this->wiki->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            $this->wikiPage->create([
                'name'            =>  $faker->sentence(3, true),
                'description'     =>  $faker->paragraph(4, true),
                'parent_id'       =>  $faker->numberBetween(1, 50),
                'user_id'         =>  $faker->randomElement($users),
                'wiki_id'         =>  $faker->randomElement($wikis),
            ]);
        }
    }
}
