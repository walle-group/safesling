<?php
//hujat yaratish
session_start();
require_once('function.php');

if (is_login()){
    $name = $_POST['docname'];
    $docinfo = $_POST['docinfo'];
    $key_count = $_POST['keycount'];
    
    $file_name = slugify(strtolower($name));
    $ffile = "../storage/docs/$file_name.json";
    if (file_exists($ffile)){
        header("Location: ../createdocument?err=bunday_nomli_hujjat_mavjud");
        exit;
    }
    
    mkdir("../storage/blocks/$file_name", 0777);
    
    //key_type - keydagi ma'lmotlar turi
    //key_info - key haqida text ma'lumot
    //key - key nomi
    
    $document = [];
    $document['name'] = $name;
    $document['info'] = $docinfo;
    
    for ($i = 1; $i <= $key_count; $i++){
        $keytype = $_POST['keytype'.$i];
        $keyinfo = $_POST['keyinfo'.$i];
        $keyname = $_POST['key'.$i];
        $key = slugify(strtolower($keyname));
        
        $document[][$key] = [
            'name' => $keyname,
            'type' => $keytype,
            'info' => $keyinfo
        ];
    }
    
    
    file_put_contents($ffile, json_encode($document));
    header("Location: ../");
}