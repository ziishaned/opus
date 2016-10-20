<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserOrganizationTableSeeder extends Seeder
{
    const USER_TYPE = [
        'normal',
        'admin'
    ];

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
    public function __construct(User $user, Organization $organization) {
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
        $faker         = Factory::create();
        $users         = $this->user->pluck('id')->all();
        $organizations = $this->organization->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {
            DB::table('user_organization')->insert([
                'user_id'         =>  $faker->randomElement($users),
                'user_type'       =>  $faker->randomElement(self::USER_TYPE),
                'organization_id' =>  $faker->randomElement($organizations),
                'created_at'      =>  Carbon::now(),
                'updated_at'      =>  Carbon::now(),
            ]);
        }
    }
}
