<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id'     => $faker->numberBetween(1,10),
        'firstname'   => $faker->firstName,
        'lastname'    => $faker->lastName,
        'address1'    => $faker->streetAddress,
        'address2'    => $faker->secondaryAddress,
        'city'        => $faker->city,
        'state'       => $faker->numberBetween(0,1),
        'country'     => $faker->numberBetween(0,1),
        'postal_code' => $faker->postcode(),
    ];
});
