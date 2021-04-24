<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Developer;
use Faker\Generator as Faker;

$factory->define(Developer::class, function (Faker $faker) {
   
        $randomNumber=rand(1,10);
        return [
            'name' => $faker->name,
            'tiering'=>$faker->name,
            'projek' =>$faker->sentence(5),
            'lokasi'=>$faker->address(10),
        ];
});
