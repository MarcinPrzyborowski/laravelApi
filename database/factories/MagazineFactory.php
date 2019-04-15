<?php

$factory->define(\App\Magazine::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
