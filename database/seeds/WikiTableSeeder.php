<?php

use Faker\Factory;
use App\Models\Wiki;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class WikiTableSeeder extends Seeder
{
    /**
     * @const array
     */
    const WIKI_TYPE = [
        'personal',
        'organization'
    ];

    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @var App\Models\Wiki
     */
    protected $wiki;

    /**
     * @var App\Models\Organization
     */
    protected $organization;

    /**
     * @param User $user App\Models\User
     * @param Wiki $wiki App\Models\Wiki
     */
    public function __construct(User $user, Wiki $wiki, Organization $organization) {
        $this->user         = $user;
        $this->wiki         = $wiki;
        $this->organization = $organization;
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
        $organizations = $this->organization->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            $this->wiki->create([
                'name'            =>  $faker->sentence(2, true),
                'description'     =>  $faker->paragraph(4, true),
                'user_id'         =>  $faker->randomElement($users),
                'wiki_type'       =>  $faker->randomElement(self::WIKI_TYPE),
                'organization_id' =>  $faker->randomElement($organizations),
            ]);
        }
        $this->wiki->where('wiki_type', '=', 'personal')->update([
            'organization_id' => null
        ]);
    }
}
