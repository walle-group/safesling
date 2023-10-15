<?php
session_start();
require_once('function.php');

if (is_login()){
    $name = $_POST['name'];
    
    $json = json_decode(file_get_contents('https://admin-safesling.2l.uz/api/getdocs?name='.$name), true)['result'];
    if ($json){
        var_dump($json);
        $arr = [];
        foreach ($json as $v){
            if (is_array($v)){
                foreach ($v as $k=>$d){
                    if ($d['type'] == 'boolean'){
                        if ($_POST[$k] == 1){
                            $vv = true;
                        } else {
                            $vv = false;
                        }
                    } else {
                        $vv = $_POST[$k];
                    }
                    
                    $arr['body'][$k] = $vv;
                   
                }
            }
        }
        
        $arr['time'] = time();
        $arr['name'] = $name;
        $arr['name_text'] = $json['name'];
        
        save_doc($arr);
        
        header("Location: ../");
    }
    
    
}