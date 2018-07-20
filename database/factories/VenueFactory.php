<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title'         => $faker->title,
        'description'   => $faker->text,
        'address1'      => $faker->address,
        'address2'      => $faker->secondaryAddress(1,10),
        'city'          => $faker->city,
        'state'         => $faker->numberBetween(1,50),
        'country'       => $faker->numberBetween(1,100),
        'postal_code'   => $faker->postcode,
        'image_path'    => $faker->imageUrl()
    ];
});
