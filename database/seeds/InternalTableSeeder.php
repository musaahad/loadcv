<?php

use Illuminate\Database\Seeder;

class InternalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Internal::class, 10)->create();
    }
}
