<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Internal;
use Faker\Generator as Faker;

use App\User;


use App\Bus;

$factory->define(Internal::class, function (Faker $faker) {
    $randomNumber=rand(1,10);
    return [
        
        'nama_debitur'=>$faker->name,
        'bus_id' => Bus::inRandomOrder()->first()->id,
        'keterangan'=>$faker->sentence(2),
        'cif' =>$faker->phoneNumber,
        'nosuratbu' =>$faker->phoneNumber,
        'jumlah_objek'=>rand(1,10),
        'tanggal_suratbu'=>$faker->date(),
        'tanggal_terima'=>$faker->date(),
       
        'users_id' => User::inRandomOrder()->first()->id,
        'status'=>$faker->sentence(1),
        
    ];
});
