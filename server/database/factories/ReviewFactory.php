<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\User;
use App\Models\Country;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(App\Models\Review::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'country_id' =>  function () {
            return factory(App\Models\Country::class)->create()->id;
        },
        'recommend' => 2.3,
        'safe' => $faker->numberBetween(1, 5),
        'cost' => $faker->numberBetween(1, 5),
        'fun' => $faker->numberBetween(1, 5),
        'tourism' => $faker->numberBetween(1, 5),
        'food' => $faker->numberBetween(1, 5),
        'english' => $faker->numberBetween(1, 5),
        'city' => $faker->text(10),
        'review' => $faker->text(10),
        'imgpath' => UploadedFile::fake()->image('test.jpg'),
    ];
});
