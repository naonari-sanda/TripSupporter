<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\User;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'country_id' =>  function () {
            return factory(App\Models\Country::class)->create()->id;
        },
        'gender' => $faker->titleMale,
        'age' => $faker->dayOfMonth,
        'profile' => $faker->text(10),
        'hobby' => $faker->text(10),
        'icon' => 'test.jpg'
    ];
});
