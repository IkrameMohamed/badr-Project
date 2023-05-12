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
            'email'      => 'ikrame@gmail.com',
            'password'   => \Hash::make('123'),
            'role_id'   => '1',
        ]);
        User::create([
            'name'  => 'ahlame',
            'email'      => 'ahlame@gmail.com',
            'password'   => \Hash::make('321'),
            'role_id'   => '2',
        ]);
    }
}
