<?php

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * @var App\Models\User
     */
    protected $user;

    /**
     * @param User $user App\Models\User
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $this->user->create([
            'name'      =>  'admin',
            'email'     =>  'admin@admin.com',
            'password'  =>  Hash::make('admin'),
        ]);

        for ($i = 0; $i < 50; $i++) {
            $this->user->create([
                'name'      =>  $faker->userName,
                'email'     =>  $faker->email,
                'password'  =>  Hash::make($faker->password),
            ]);
        }
    }
}
