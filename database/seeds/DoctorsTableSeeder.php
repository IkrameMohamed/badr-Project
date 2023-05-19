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
            'name'  => 'Dr Lakhal',
            'discount' => 30 ,
            'number_days_available' => 2
        ]);
        Doctor::create([
            'name'  => 'Dr Zaid',
            'discount' => 50 ,
            'number_days_available' => 6
        ]);
        Doctor::create([
            'name'  => 'Dr Missoum',
            'discount' => 50 ,
            'number_days_available' => 4
        ]);
        Doctor::create([
            'name'  => 'Dr Bouras',
            'discount' => 50 ,
            'number_days_available' => 5
        ]);
        Doctor::create([
            'name'  => 'Dr Naili',
            'discount' => 50 ,
            'number_days_available' => 3
        ]);
        Doctor::create([
            'name'  => 'Cardiologue Boumahdi',
            'discount' => 50 ,
            'number_days_available' => 3
        ]);
        Doctor::create([
            'name'  => 'Cardiologue Lekhal Cabinet Ferhat',
            'discount' => 100 ,
            'number_days_available' => 4
        ]);
        Doctor::create([
            'name'  => 'Dr Medah',
            'discount' => 100 ,
            'number_days_available' => 3
        ]);
        Doctor::create([
            'name'  => 'Dr Zemouri',
            'discount' => 100 ,
            'number_days_available' => 5
        ]);
        Doctor::create([
            'name'  => 'Dr khatib',
            'discount' => 50 ,
            'number_days_available' => 5
        ]);
        Doctor::create([
            'name'  => 'Dr Kara',
            'discount' => 40 ,
            'number_days_available' => 3
        ]);
        Doctor::create([
            'name'  => "L'hopital Fabor",
            'discount' => 100 ,
            'number_days_available' => 2
        ]);
        Doctor::create([
            'name'  => "Dr Bn Dahbia",
            'discount' => 60 ,
            'number_days_available' => 3
        ]);
        Doctor::create([
            'name'  => 'Dr Osalem',
            'discount' => 100 ,
            'number_days_available' => 4
        ]);
        Doctor::create([
            'name'  => 'Dr Mansour',
            'discount' => 70 ,
            'number_days_available' => 5
        ]);
    }
}
