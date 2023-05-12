<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array([
            'name' => 'logo',
            'value' => 'logo-sidebar.png',
        ], [
            'name' => 'company_name',
            'value' => 'Pharmacy',
        ],
            [
                'name' => 'company_number',
                'value' => '0673379115',
            ], [
            'name' => 'theme_color',
            'value' => 'megna',
        ],
            );

        /**
         * in the future add ['name' => 'max_user_devices','value' => '',]  to manage max user connect with same account
         */
        Setting::insert($data);
    }
}
