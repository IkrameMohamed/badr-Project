<?php

use App\House;
use Illuminate\Database\Seeder;
use App\User;
class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::create([
            'name'  => 'BADR 1',
            'type'      => 'MEN',
        ]);
        House::create([
            'name'  => 'BADR 2',
            'type'      => 'WOMEN',
        ]);
        House::create([
            'name'  => 'IHESAN',
            'type'      => 'ALL',
        ]);
    }
}
