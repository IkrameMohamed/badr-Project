<?php

use App\Doctor;
use Illuminate\Database\Seeder;
class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
            'name'  => 'ikrame',
            'discount' => 50 ,
            'number_days_available' => 2
        ]);
        Doctor::create([
            'name'  => 'ahlame',
            'discount' => 70 ,
            'number_days_available' => 2
        ]);
    }
}
