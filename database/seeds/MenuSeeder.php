<?php

use Illuminate\Database\Seeder;
use App\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $menu = array(
            ['name'=>'manage_users', 'href'=>NULL, 'class'=>'has-arrow waves-effect waves-dark', 'icon'=>'fas fa-user', 'slug'=>'dropdown', 'parent_id'=>null, 'menu_type'=>'sidebar', 'sequence'=>'1'],
            ['name'=>'all_users', 'href'=>'/users', 'class'=>'', 'icon'=>'', 'slug'=>'link', 'parent_id'=>1, 'menu_type'=>'sidebar', 'sequence'=>'2'],
            ['name'=>'roles', 'href'=>'/roles', 'class'=>'', 'icon'=>'', 'slug'=>'link', 'parent_id'=>1, 'menu_type'=>'sidebar', 'sequence'=>'3'],

            ['name'=>'manage_medicines', 'href'=>NULL, 'class'=>'has-arrow waves-effect waves-dark', 'icon'=>'fas fa-microscope', 'slug'=>'dropdown', 'parent_id'=>null, 'menu_type'=>'sidebar', 'sequence'=>'4'],
            ['name'=>'medicines', 'href'=>'/medicines', 'class'=>'', 'icon'=>'', 'slug'=>'link', 'parent_id'=>4, 'menu_type'=>'sidebar', 'sequence'=>'5'],
            ['name'=>'search', 'href'=>'/medicines/search', 'class'=>'', 'icon'=>'', 'slug'=>'link', 'parent_id'=>4, 'menu_type'=>'sidebar', 'sequence'=>'6'],

            ['name'=>'settings', 'href'=>'/settings', 'class'=>'has-arrow waves-effect waves-dark', 'icon'=>'fa fa-cog', 'slug'=>'link', 'parent_id'=>null, 'menu_type'=>'sidebar', 'sequence'=>'7'],

            ['name'=>'translations', 'href'=>'/languages/fr/translations', 'class'=>'has-arrow waves-effect waves-dark','icon'=>'fa fa-language', 'slug'=>'link', 'parent_id'=>null, 'menu_type'=>'sidebar', 'sequence'=>'8'],
            );
        Menu::insert($menu);

    }
}
