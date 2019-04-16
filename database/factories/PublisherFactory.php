<?php

$factory->define(\App\Models\Publisher::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
