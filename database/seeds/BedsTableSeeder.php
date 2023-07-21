<?php

use App\Bed;
use App\House;
use Illuminate\Database\Seeder;
use App\User;
class BedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 40; $x++) {
            Bed::create([
                'code_bare'  => 'BADR 1 BED ' . $x,
                'house_id'      => 1,
            ]);
        }

        for ($x = 1; $x <= 30; $x++) {
            Bed::create([
                'code_bare'  => 'BADR 2 BED ' . $x,
                'house_id'      => 2,
            ]);
        }

        for ($x = 1; $x <= 25; $x++) {
            Bed::create([
                'code_bare'  => 'IHSAN 3 BED ' . $x,
                'house_id'      => 3,
            ]);
        }
    }
}
