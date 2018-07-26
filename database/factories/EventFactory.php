<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    $futuredate = date('Y-m-d', strtotime('+1 year'));
    $startdate = $faker->dateTimeBetween('now', $futuredate);
    $enddate = $faker->dateTimeBetween($startdate, $futuredate);
    return [
        'user_id'       => $faker->numberBetween(1,10),
        'title'         => $faker->title,
        'description'   => $faker->sentence(5),
        'venue_id'      => factory('App\Venue')->create()->id,
        'startdate'     => $startdate,
        'enddate'       => $enddate,
        'is_oneday'     => $faker->numberBetween(0,1),
        'is_allday'     => $faker->numberBetween(0,1),
    ];
});
