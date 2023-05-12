<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;
use App;
use DB;


class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if (\Schema::hasTable('settings')) {
            // reload cache
            // this loads cache one time at boot 
            // clear cache if any loading probme
            Cache::rememberForever('settings', function () {
                return DB::table('settings')->select('name','value')->get();
            });

        }
    }
}
