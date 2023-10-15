<?php
//hujjatlarni ularni nomi bilan qaytaradi
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
if (isset($_GET['name'])){
    $name = $_GET['name'];
    $file = "../storage/docs/$name.json";
    
    if (file_exists($file)){
        $json = json_decode(file_get_contents($file), true);
        $result = [
            'ok' => true,
            'result' => $json
        ];
        
    } else {
        $result = [
            'ok' => false
        ];
    }
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