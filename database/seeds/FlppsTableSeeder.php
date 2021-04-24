<?php

use Illuminate\Database\Seeder;

class FlppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Flpps::class, 10)->create();
    }
}
