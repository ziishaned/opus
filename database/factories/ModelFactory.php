<?php

use Carbon\Carbon;
use App\Models\Wiki;

$factory->define(Wiki::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'slug'        => str_slug($faker->name),
        'space_id'    => $faker->numberBetween(1, 400),
        'outline'     => $faker->paragraph(),
        'description' => $faker->paragraph(),
        'user_id'     => $faker->numberBetween(1, 400),
        'team_id'     => $faker->numberBetween(1, 400),
        'updated_at'  => Carbon::now(),
        'created_at'  => Carbon::now(),
    ];
});
