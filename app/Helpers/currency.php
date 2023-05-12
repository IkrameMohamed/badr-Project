<?php


/**
 * get menus from cache function
 *
 * @param string $name
 *
 * @return void
 */

use Illuminate\Support\Facades\Schema;


/**
 * get currency
 * @return \Illuminate\Cache\CacheManager|mixed
 * @throws Exception
 */
function currency(string $key = NULL)
{
    $lang = "currency";
    if ($key)
        $lang. '.' .$key ;
    return __($lang);
}

function getCurrencySymbol($key = 'DZD'){

    return __('currency.'.$key.'.symbol');
}


