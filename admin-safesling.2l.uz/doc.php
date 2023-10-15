<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
require_once('cabinet/function.php');
if (!is_login()){
    header("Location: login");
    exit;
}

$page = page('doc');

if (isset($_GET['name'])){
    $name = $_GET['name'];
    $json = json_decode(file_get_contents('https://admin-safesling.2l.uz/api/getdocs?name='.$name), true)['result'];
    
    if ($json){
        $page = page_change('ss_doc_name', $json['name'], $page);
        
        $block = json_decode(file_get_contents('https://admin-safesling.2l.uz/api/getblock?name='.$name), true)['result'];
        
        $div1 = '';
        foreach ($block as $k1=>$v1){
            if (is_array($v1)){
                $div1 .= '<div class="doc">';
                
                $div1 .= '<div>
                    <p>id</p>
                    <p>'.$k1.'</p>
                </div>';
                            
                foreach ($v1 as $k=>$v){
                    if (is_array($v)){
                        foreach ($v as $k2=>$v2){
                            $div1 .= '<div>
                                <p>'.$k2.'</p>
                                <p>'.$v2.'</p>
                            </div>';
                        }
                    } else {
                        $div1 .= '<div>
                                <p>'.$k.'</p>
                                <p>'.$v.'</p>
                            </div>';
                    }
                }
                $div1 .= '</div>';
            }
            
        }
        
        $page = page_change('ss_key_values', $div1, $page);

    } else {
        header("Location: ./");
    }
} else {
    header("Location: ./");
}

echo $page;
?>