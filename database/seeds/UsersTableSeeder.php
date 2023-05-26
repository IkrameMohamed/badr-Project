<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'ikrame',
            'last_name' => 'mohamed',
            'phone' => '1234567890',
            'email'      => 'ikrame@gmail.com',
            'password'   => \Hash::make('123'),
            'role_id'   => '1',
        ]);
        User::create([
            'name'  => 'ahlame',
            'last_name' => 'ahlame',
            'phone' => '1234567890',
            'email'      => 'ahlame@gmail.com',
            'password'   => \Hash::make('321'),
            'role_id'   => '2',
        ]);
    }
}
