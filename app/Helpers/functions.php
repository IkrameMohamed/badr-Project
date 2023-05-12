<?php


/**
 * get menus from cache function
 *
 * @param string $name
 *
 * @return void
 */

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;


/**
 * get settings
 * @return \Illuminate\Cache\CacheManager|mixed
 * @throws Exception
 */
function settings ($name)
{
    $setting = cache('settings')->where('name', $name)->first();
    return (is_object($setting)) ? $setting->value : NULL;
}


/**
 * get menus
 * @return \Illuminate\Cache\CacheManager|mixed
 * @throws Exception
 */
function menus ()
{
    $menu = cache('menus');
    return $menu;
}



/**
 * get menus
 * @return \Illuminate\Cache\CacheManager|mixed
 * @throws Exception
 */
function permissionMenus ()
{
    return \App\Menu::whereNull('parent_id')->with(['children','permissions.authUser'])->orderBy('sequence')->get()->toArray();
}

/**
 * get menus from cache function
 *
 * @param string $name
 *
 * @return void
 */
function lang ()
{
    $user_lang = \Illuminate\Support\Facades\Auth::user()->lang;
    $app_lang = \Illuminate\Support\Facades\App::getLocale();

    if($user_lang != $app_lang) {

        \Illuminate\Support\Facades\App::setLocale($user_lang);
        session()->put('locale', $user_lang);
    }

    return $user_lang;
}


/**
 * get enum value from table
 *
 * @param string $name
 *
 * @return void
 */
function getEnumValues ($table, $column)
{
    $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enum = array();
    $i = 0;
    foreach(explode(',', $matches[1]) as $value) {
        $v = trim($value, "'");
        $enum[$i++] = $v;
    }
    return $enum;
}

function tableColumnValidation ($table = '', $column = '')
{
    if(Schema::hasTable($table) && (Schema::hasColumn($table, $column))) {
        return true;
    } else {
        return false;
    }

}

/**
 * get table list
 *
 * @param $table
 *
 * @return mixed
 */
function getTableList ($table)
{
    $table = DB::table($table)->whereNull('deleted_at')->where('name','!=','Sysadmin')->get();

    return $table;
}

function getTableFieldRow ($table, $id, $columnName)
{
    $table = DB::table($table)->where('id', $id)->pluck($columnName)->first();
    return $table;
}


function getTableFields($table,$options): array
{
    $tableStructure = array();

    foreach ($table["table_fields"] as $rs)
        $tableStructure[] = $rs;

    foreach ($table["table_fk_fields"] as $rs)
        $tableStructure[] = $rs;

    $tableStructure = collect($tableStructure)->sortBy('position')->toArray();

    if(isset($options['onlyColumnsNames']) && $options['onlyColumnsNames'] == true)
        return Arr::pluck($tableStructure, "field_name");

    return $tableStructure;
}

function keysAreEqual($array1, $array2)
{
    return empty(array_diff_assoc($array1, $array2)) && empty(array_diff_assoc($array2, $array1));
}
