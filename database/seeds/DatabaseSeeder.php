<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //perhatikan urutan. yg jadi foreign key paling awal dibuat seedernya
       // $this->call(RolesTableSeeder::class);
      //  $this->call(AdminUserSeeder::class);
        $this->call(KjppsTableSeeder::class);
        $this->call(BusTableSeeder::class);
       
     
        $this->call(DeveloperTableSeeder::class);
        $this->call(FlppsTableSeeder::class);
        $this->call(InternalTableSeeder::class);
        $this->call(VercallTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
    }
}
