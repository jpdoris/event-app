<?php

use Faker\Generator as Faker;

$factory->define(App\Speaker::class, function (Faker $faker) {
    return [
        'firstname'   => $faker->firstName,
        'lastname'    => $faker->lastName,
        'title'    => $faker->jobTitle,
        'bio' => $faker->paragraph,
        'image_path' => $faker->imageUrl()
    ];
});
