<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flpp;
use Faker\Generator as Faker;
use App\User;
use App\Developer;
use App\Bus;
use App\Flpps;

$factory->define(Flpps::class, function (Faker $faker) {
    $randomNumber=rand(1,10);
    return [
        
        'developer_id' => Developer::inRandomOrder()->first()->id,
        'nama_debitur'=>$faker->name,
        'bus_id' => Bus::inRandomOrder()->first()->id,
        'keterangan'=>$faker->sentence(3),
        'no_rek' =>$faker->phoneNumber,
        'nosuratbu' =>$faker->phoneNumber,
        'jumlah_objek'=>rand(1,10),
        'tanggal_suratbu'=>$faker->date(),
        'tanggal_terima'=>$faker->date(),
        
        'users_id' => User::inRandomOrder()->first()->id,
        'status'=>$faker->sentence(2),
        
    ];
});
