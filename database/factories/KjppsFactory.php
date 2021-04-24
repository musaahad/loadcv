<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kjpps;
use Faker\Generator as Faker;

$factory->define(Kjpps::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'pimpinan'=> $faker->name,
        'nomappi' =>$faker->phoneNumber,
        'ijinpublik' =>$faker->phoneNumber,
    ];
});
