<?php

use Faker\Generator as Faker;

$factory->define(App\Session::class, function (Faker $faker) {
    $futuredate = date('Y-m-d', strtotime('+1 year'));
    $startdate = $faker->dateTimeBetween('now', $futuredate);
    $enddate = $faker->dateTimeBetween($startdate, $futuredate);
    return [
        'title' => $faker->title,
        'description' => $faker->sentence(10),
        'startdate'     => $startdate,
        'enddate'       => $enddate,
        'is_keynote'    => $faker->boolean
    ];
});
