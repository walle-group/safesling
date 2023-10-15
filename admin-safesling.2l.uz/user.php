<?php
function count_f(){
    $doc_count = count(scandir('storage/docs')) - 2;
    $block_count = 0;
    $blocks = scandir('storage/docs');
    foreach ($blocks as $v){
        if ($v == '.' or $v == '..'){
            continue;
        }
        
        $path = substr($v, 0, -5);
    
        $block_count += count(scandir("storage/blocks/$path")) - 2;
    }
    
    return ['doc' => $doc_count, 'block' => $block_count];
}
session_start();
require_once('cabinet/function.php');
if (!is_login()){
    header("Location: login");
    exit;
}

if (isset($_GET['delete'])){
    $user_id = $_GET['id'];
    unlink("storage/users/$user_id.json");
    header("Location: ./");
}

$page = page('user');
if (isset($_GET['id'])){
    $user_id = $_GET['id'];
    $page = page_change('ss_user_id', $user_id, $page);
} else {
    header("Location: ./");
}

$file = "storage/users/$user_id.json";

$arr = json_decode(file_get_contents($file), true);

$page = page_change('ss_name', $arr['name'], $page);
$page = page_change('ss_endpoint_url', $arr['url'], $page);

$is_work = json_decode(file_get_contents($arr['url']."/iswork"), true)['ok'];
if ($is_work == true){
    $is_work = "Ishlamoqda";
} else {
    $is_work = "Ishlamayapdi";
    goto stop;
}
$page = page_change('ss_iswork', $is_work, $page);

$docs = json_decode(
        file_get_contents($arr['url']."/getdocs"),
        true)['result'];
        
    
        
$page = page_change('ss_doc_count', count($docs), $page);

$block_count = 0;
foreach ($docs as $v){
    $block = json_decode(
        file_get_contents($arr['url']."/getblock?name=$v"),
        true)['result'];
        
    $block_count += count($block);
}

$page = page_change('ss_block_count', $block_count, $page);

//indexlash foizi
$count_f = count_f();

$foiz = (($count_f['doc'] + $count_f['block'])/($block_count +  count($docs)))*100;
$page = page_change('ss_indexed_persent', $foiz."%", $page);

stop:
echo $page;
?>