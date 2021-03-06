<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
            'name' => 'Admin Load CV',
            'email'=> 'admin@loadcv.com',
            'password'=> bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');
    }
}
