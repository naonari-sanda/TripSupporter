<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 3),
        'country_id' => $faker->numberBetween(1, 20),
        'recommend' => $faker->numberBetween(1, 5),
        'safe' => $faker->numberBetween(1, 5),
        'cost' => $faker->numberBetween(1, 5),
        'fun' => $faker->numberBetween(1, 5),
        'tourism' => $faker->numberBetween(1, 5),
        'food' => $faker->numberBetween(1, 5),
        'english' => $faker->numberBetween(1, 5),
    ];
});
