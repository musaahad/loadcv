<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;
use App\Lokasi;
use App\User;
use App\Status;
use App\Bu;
use App\Bus;
use App\Kjpp;
use App\Kjpps;
use App\Reviews;

$factory->define(Reviews::class, function (Faker $faker) {
    $randomNumber=rand(1,11);
    return [
        
        'kjpps_id' => Kjpps::inRandomOrder()->first()->id,
        'nama_debitur'=>$faker->name,
        'bus_id' => Bus::inRandomOrder()->first()->id,
        'keterangan'=>$faker->sentence(2),
        'jumlah_objek'=>rand(1,10),
        'tanggal_suratbu'=>$faker->date(),
        'tanggal_terima'=>$faker->date(),
        
        'nosuratbu' =>$faker->phoneNumber,
        'users_id' => User::inRandomOrder()->first()->id,
        'cif' =>$faker->phoneNumber,
        'status'=>$faker->sentence(1),
        'tujuan'=>$faker->sentence(1),
        'no_lpa' =>$faker->phoneNumber,
        'tanggal_lpa'=>$faker->date(),

    ];


});
