<?php

$factory->define(\App\Publisher::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});
