<?php

use Illuminate\Database\Seeder;

class VercallTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vercall::class, 10)->create();
    }
}
