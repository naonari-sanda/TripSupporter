<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(App\Models\Acount::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'gender' => $faker->text(5),
        'age' => $faker->text(5),
        'hobby' => $faker->text(10),
        'profile' => $faker->text(10),
        'icon' => UploadedFile::fake()->image('test.jpg')
    ];
});
