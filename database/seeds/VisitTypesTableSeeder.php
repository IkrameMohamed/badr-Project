<?php

use App\VisitType;
use Illuminate\Database\Seeder;
use App\User;
class VisitTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisitType::create([
            'name'  => 'Scanner'
        ]);
        VisitType::create([
            'name'  => 'IRM'
        ]);
        VisitType::create([
            'name'  => 'Echographie'
        ]);
        VisitType::create([
            'name'  => 'Mamographie'
        ]);
        VisitType::create([
            'name'  => 'Scientigraphie'
        ]);
        VisitType::create([
            'name'  => 'Coloscopie'
        ]);
        VisitType::create([
            'name'  => 'Rdiographie'
        ]);
        VisitType::create([
            'name'  => 'Biopsie'
        ]);
        VisitType::create([
            'name'  => 'Médecin généraliste'
        ]);
        VisitType::create([
            'name'  => 'Médecin spécialiste'
        ]);
        VisitType::create([
            'name'  => 'Labo et les analyses'
        ]);


    }
}
