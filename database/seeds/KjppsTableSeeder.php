<?php

use Illuminate\Database\Seeder;

class KjppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Kjpps::class, 10)->create();
    }
}
