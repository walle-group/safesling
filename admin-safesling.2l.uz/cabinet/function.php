<?php
function slugify($string, $replace = array(), $delimiter = '_')
{
    if (!extension_loaded('iconv')) {
        throw new Exception('iconv module not loaded');
    }
    // Save the old locale and set the new locale to UTF-8
    $oldLocale = setlocale(LC_ALL, '0');
    setlocale(LC_ALL, 'en_US.UTF-8');
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    if (!empty($replace)) {
        $clean = str_replace((array) $replace, ' ', $clean);
    }
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower($clean);
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    $clean = trim($clean, $delimiter);
    // Revert back to the old locale
    setlocale(LC_ALL, $oldLocale);
    return $clean;
}

function is_login(){
    if ($_SESSION['admin'] == true){
        return true;
    } else {
        return false;
    }
}

function page($name){
    return file_get_contents("html/$name.html");
}

function page_change($key, $value, $page){
    return str_replace($key, $value, $page);
}

function save_doc($arr){
    $name = $arr['name'];
    $path = "../storage/blocks/$name";
    $number = count(scandir($path)) - 1;
    
    if ($number == 1){
        $arr['prev_hash'] = '';
    } else {
        $hash = hashes($name, $number-1);
        $arr['prev_hash'] = $hash;
    }
    
    file_put_contents($path."/$number.json", json_encode($arr));
    return $number;
}

function hashes($name, $id){
    return md5(file_get_contents("../storage/blocks/$name/$id.json"));
}


