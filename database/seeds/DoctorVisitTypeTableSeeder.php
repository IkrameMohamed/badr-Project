<?php

use App\DoctorVisitType;
use App\VisitType;
use Illuminate\Database\Seeder;
use App\User;
class DoctorVisitTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorVisitType::create([
            'doctor_id'  => '1',
            'visit_type_id'  => '1'
        ]);
        DoctorVisitType::create([
            'doctor_id'  => '1',
            'visit_type_id'  => '3'
        ]);
        DoctorVisitType::create([
            'doctor_id'  => '2',
            'visit_type_id'  => '1'
        ]);
    }
}
