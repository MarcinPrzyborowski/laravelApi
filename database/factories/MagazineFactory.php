<?php

$factory->define(\App\Models\Magazine::class, function (\Faker\Generator $faker) {
    return [
        'name' => 'magazine_'.$faker->name,
    ];
});
