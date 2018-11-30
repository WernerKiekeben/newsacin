<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->text,
        'publication' => $faker->date(),
        'idUser' => $faker->randomDigitNotNull,
        'idState' => $faker->numberBetween(1,2),
    ];
});
