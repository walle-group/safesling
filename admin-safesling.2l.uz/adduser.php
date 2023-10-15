<?php
session_start();
require_once('cabinet/function.php');
if (!is_login()){
    header("Location: login");
    exit;
}

$page = page('adduser');

$err = '';
if (isset($_GET['err'])){
    $err = str_replace("_", " ", $_GET['err']);
}
$page = page_change('ss_error', $err, $page);

echo $page;
?>