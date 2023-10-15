<?php
//hujjatni blokini qaytaradi
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
if (isset($_GET['name'])){
    $name = $_GET['name'];
    $file = "../storage/blocks/$name";
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $arr = json_decode(file_get_contents("$file/$id.json"), true);
    } else {
        $files = scandir($file);
        
        $arr = [];
        foreach ($files as $v){
            if ($v == '.' or $v == '..'){
                continue;
            }
            
            $v2 = substr($v, 0, -5);
            $arr[$v2] = json_decode(file_get_contents("$file/$v"), true);
            
        }
    }
        $result = [
            'ok' => true,
            'result' => $arr
        ];
} else {
    $dir = scandir('../storage/docs');
    
    $arr = [];
    foreach ($dir as $v){
        if ($v == '.' or $v == '..'){
            continue;
        }
        $arr[] = substr($v, 0, -5);
    }
    
    $result = [
        'ok' => true,
        'result' => $arr
    ];
}

echo json_encode($result);