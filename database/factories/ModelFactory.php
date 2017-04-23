<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Wiki::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'slug'        => str_slug($faker->name),
        'space_id'    => $faker->numberBetween(1, 400),
        'outline'     => $faker->paragraph(),
        'description' => $faker->paragraph(),
        'user_id'     => $faker->numberBetween(1, 400),
        'team_id'     => $faker->numberBetween(1, 400),
        'updated_at'  => \Carbon\Carbon::now(),
        'created_at'  => \Carbon\Carbon::now()
    ];
});
