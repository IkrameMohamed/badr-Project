<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Cache;
use App;
use DB;


class MenusServiceProvider extends ServiceProvider
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

        if (\Schema::hasTable('menus')) {
            // reload cache
            // this loads cache one time at boot 
            // clear cache if any loading probme
            Cache::rememberForever('menus', function () {
                return App\Menu::whereNull('parent_id')->with('children')->get();
            });


        }
    }
}
