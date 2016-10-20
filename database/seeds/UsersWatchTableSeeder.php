<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\WikiPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersWatchTableSeeder extends Seeder
{
    /**
     * @const array
     */
    const ENTITY_TYPE = [
        'wiki',
        'page'
    ];

    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @var App\Models\WikiPage
     */
    protected $wikiPage;

    /**
     * @param User     $user     App\Models\User
     * @param WikiPage $wikiPage App\Models\WikiPage
     * @param DB       $db       Illuminate\Support\Facades\DB
     */
    public function __construct(User $user, WikiPage $wikiPage) 
    {
        $this->user     = $user;
        $this->wikiPage = $wikiPage;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = $this->user->pluck('id')->all();
        $pages = $this->wikiPage->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            DB::table('user_watch')->insert([
                'user_id'      => $faker->randomElement($users),
                'entity_id'    => $faker->randomElement($pages),
                'entity_type'  => $faker->randomElement(self::ENTITY_TYPE),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }
    }
}
