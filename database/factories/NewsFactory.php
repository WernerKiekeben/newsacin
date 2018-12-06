<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->text,
        'publication' => $faker->dateTimeBetween('-20 years', 'now'),
        'idUser' => $faker->numberBetween(1,9),
        'idState' => $faker->numberBetween(1,2),
    ];
});
