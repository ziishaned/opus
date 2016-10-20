<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @var App\Models\Organization
     */
    protected $organization;

    /**
     * @param User         $user         App\Models\User
     * @param Organization $organization App\Models\Organization
     */
    function __construct(User $user, Organization $organization) {
        $this->user         = $user;
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
        for ($i = 0; $i < 50; $i++) {
            $this->organization->create([
                'name'    =>  $faker->company,
                'user_id' =>  $users[$i]
            ]);
        }
    }
}
