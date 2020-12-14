<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->country,
        'imgpath' => 'ここに画像urlが入ります',
        'area' => $faker->numberBetween($min = 1, $max = 100000),
        'population' => $faker->numberBetween($min = 1, $max = 100000),
        'capital' => $faker->city,
        'language' => 'ここに言語が入ります',
        'religion' => 'ここに主宗教が入ります',
        'detail' => $faker->text(),
        'covid' => '入国不可',
        'map' => 'ここにマップが入ります',
        'comment' => 'ここに詳細が入ります。',
    ];
});
