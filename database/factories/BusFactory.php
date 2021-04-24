<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bus;
use Faker\Generator as Faker;

$factory->define(Bus::class, function (Faker $faker) {
    $randomNumber=rand(1,10);
    return [
        'name' => $faker->name,
        'tar_tat'=>rand(1,10),
        'alamatbu'=> $faker->address(6),
        'jenis' =>$faker->sentence(5),

    ];
});
