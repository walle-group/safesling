<?php
session_start();
require_once('function.php');

if (is_login()){
    $name = $_POST['name'];
    $url = $_POST['url'];
    
    if (strlen($name) > 0 and strlen($url)){
        $ok = json_decode(file_get_contents($url."/iswork"));
        
        if ($ok->ok == true){
            $sonfile = "../storage/user_count.txt";
            $son = file_get_contents($sonfile) + 1;
            file_put_contents($sonfile, $son);
            
            $arr = [];
            $arr['name'] = $name;
            $arr['url'] = $url;
            
            file_put_contents("../storage/users/$son.json", json_encode($arr));
            
            header("Location: ../");
        } else {
            header("Location: ../adduser?err=endpoint_url_ishlamayapdi");
        }
        
    }
}