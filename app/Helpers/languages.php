<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;


//------------------------------------------------------------------------------
// Add or modify lang files content
//------------------------------------------------------------------------------

function createLangKey($key, $value, $fileName = 'field')
{

    if (!check_lang_key_exist($fileName, $key)) {
        foreach (['ar', 'en', 'fr'] as $lang) {
            $path = base_path() . '/resources/lang/' . $lang . '/' . $fileName . '.php';
            $arrayLang = readLangFle($fileName,true,$lang);
            $arrayLang[$key] = $value;
            save($arrayLang, $path);
        }
    }
}


//------------------------------------------------------------------------------
// Read lang file content
//------------------------------------------------------------------------------

function readLangFle($fileName ,$returnarray = true , $language = '')
{
    $arrayLang = Lang::get($fileName,[],$language);
    if (gettype($arrayLang) == 'string')
        $arrayLang = array();

    return ($returnarray) ? $arrayLang : response()->json($arrayLang)->getContent();
}

//------------------------------------------------------------------------------
// Save lang file content
//------------------------------------------------------------------------------

function save($arrayLang, $path)
{
    $content = "<?php\n\nreturn\n[\n";
    foreach ($arrayLang as $key => $value) {
        $content .= "\t'" . $key . "' => '" . $value . "',\n";
    }
    $content .= "];";
    file_put_contents($path, $content);
}

function check_lang_key_exist($fileName, $key)
{
    foreach (['ar', 'en', 'fr'] as $lang) {
        if (Lang::has($fileName .'.'. $key, $lang)) {
            return true;
        }
    }
    return false;
}

