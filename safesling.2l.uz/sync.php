<?php
$api = 'https://admin-safesling.2l.uz/api/';
$path = "storage/";
$block_path = $path."blocks";
$docs_path = $path."docs";

function read_arr($url){
    return json_decode(file_get_contents($url), true);
}

$docs = read_arr($api."getdocs")['result'];

foreach ($docs as $v){

    if (!file_exists($docs_path."/$v.json")){
        $doc_file = read_arr($api."getdocs?name=$v");
        
        file_put_contents($docs_path."/$v.json", json_encode($doc_file));
    }
    
    $blocks = read_arr($api."getblock?name=".$v)['result'];
    
    foreach ($blocks as $k2=>$v2){
        if (!is_dir($block_path."/$v")){
            mkdir($block_path."/$v", 0777);
        }
        
        if (!file_exists($block_path."/$v/$k2.json")){
            file_put_contents($block_path."/$v/$k2.json", json_encode($v2));
        }
    }
    
    
}

