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
            'name'  => 'type_1'
        ]);
        VisitType::create([
            'name'  => 'type_2'
        ]);
        VisitType::create([
            'name'  => 'type_3'
        ]);
    }
}
