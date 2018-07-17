<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $futuredate = date('Y-m-d', strtotime('+1 year'));
    $startdate = $faker->dateTimeBetween('now', $futuredate);
    $enddate = $faker->dateTimeBetween($startdate, $futuredate);
    return [
        'owner_id'      => $faker->name,
        'title'         => $faker->title,
        'description'   => $faker->sentence,
        'location_id'   => $faker->numberBetween(1,10),
        'startdate'     => $startdate,
        'enddate'       => $enddate,
        'is_oneday'     => $faker->numberBetween(0,1),
        'is_allday'     => $faker->numberBetween(0,1),
    ];
});
