<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->country,
        'area' => $faker->numberBetween($min = 1, $max = 100000),
        'population' => $faker->numberBetween($min = 1, $max = 100000),
        'capital' => $faker->city,
        'language' => 'ここに言語が入ります',
        'religion' => 'ここに主宗教が入ります',
        'gdp' => $faker->numberBetween($min = 1, $max = 100000),
        'happiness' => $faker->numberBetween($min = 1, $max = 100000),
        'covid' => '入国不可',
        'detail' => 'ここに詳細が入ります。',
        'comment' => 'ここに詳細が入ります。',
    ];
});
