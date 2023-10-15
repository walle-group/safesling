<?php
$files = scandir('../storage/users');

$arr = [];
foreach ($files as $v){
    if ($v == '.' or $v == '..'){
        continue;
    }
    
    $file = json_decode(file_get_contents('../storage/users/'.$v), true);
    
    $arr[] = $file;
}

echo json_encode($arr);