<?php
session_start();
require_once('cabinet/function.php');
if (!is_login()){
    header("Location: login");
    exit;
}

$page = page('index');

$docc = json_decode(file_get_contents('https://admin-safesling.2l.uz/api/getdocs'), true)['result'];

$doc_list = '';
$add_doc = '';
foreach ($docc as $v){
    $doc_list .= '<p><a href="doc?name='.$v.'">'.$v.'</a> <a href="doc?name='.$v.'">ko\'rish</a></p>';
    
    $add_doc .= '<a href="adddocument?name='.$v.'">'.$v.'</a>';
}

$page = page_change('ss_doc_list', $doc_list, $page);
$page = page_change('ss_add_docs', $add_doc, $page);

$doc_count = count(scandir('storage/docs')) - 2;
$page = page_change('ss_doc_count', $doc_count, $page);

$block_count = 0;

$block_counttxt ='';

$blocks = scandir('storage/docs');
foreach ($blocks as $v){
    if ($v == '.' or $v == '..'){
        continue;
    }
    
    $path = substr($v, 0, -5);

    $block_count += count(scandir("storage/blocks/$path")) - 2;
}
$page = page_change('ss_block_count', $block_count, $page);

$users = scandir('storage/users');
$page = page_change('ss_user_count', count($users) - 2, $page);

$html = '';
foreach ($users as $v){
    if ($v == '.' or $v == '..'){
        continue;
    }
    
    $file = "storage/users/$v";
    $json = json_decode(file_get_contents($file), true);
    $id = substr($v, 0, -5);
    
    $html .= '<p><a href="user?id='.$id.'">'.$json['name'].'</a></p>';

    $block_count += count(scandir("storage/blocks/$path")) - 2;
}

$page = page_change('ss_user_list', $html, $page);

echo $page;

?>