<?php

function get_array_block(){
    
}

function arr($url){
    return json_decode(file_get_contents($url), true)['result'];
}

function hashes($name, $id){
    return md5(file_get_contents("../storage/blocks/$name/$id.json"));
}

function get_blocks($doc_name){
    $api = 'https://admin-safesling.2l.uz/api/';
    
    $arr = arr($api."getblock?name=$doc_name")['result'];
    return $arr;
}

function check($name, $id){
    $api = 'https://admin-safesling.2l.uz/api/';
    $aaa = hash_check($name, $id);
    if (strlen($aaa) > 10) $api = $aaa."/";
    
    $arr = arr($api."getdocs");
    
    $block = arr($api."getblock?name=scienceinnvation");
    
    for ($i=1; $i<=$id; $i++){
        
    }
    
    $txt = md5(json_encode($block[1]));
    //var_dump($txt);
    
    /////////
    $json = arr($api.'getblock?name='.$name.'&id='.$id);
    
    $html = '';
    foreach ($json as $k=>$v){
        if (!is_array($v)){
            $html .= "<div>
                    <p>$k</p>
                    <p>$v</p>
                </div>";
        } else {
            foreach ($v as $k2=>$v2){
                $html .= "<div>
                        <p>$k2</p>
                        <p>$v2</p>
                    </div>";
            }
        }
    }
    //var_dump($json);
    $aaa = hash_check($name, $id);
    
    
    
    return $html;
}

function hash_check($name, $id){
    $api = 'https://admin-safesling.2l.uz/api/';
    $users = json_decode(file_get_contents($api.'getuser'), true);
    $url_list = [];
    $i = 0;
    foreach ($users as $v){
        $url_list[$i] = $v['url'];
        $i++;
    }
    
    $hash_arr = [];
    foreach ($url_list as $k => $v){
        $block = arr($v."/getblock?name=$name");
        
        $txt = '';
        foreach ($block as $k2 => $v2){
            $txt .= md5(json_encode($v2));
            if ($k2 == $id){
                break;
            }
        }
        
        $hash_arr[] = md5($txt);
        
    }
    
    
    
    $jastota = [];
    
    foreach ($hash_arr as $k=>$v){
        $jastota[$v] ++;
        ///
        if ($jastota[$v] == 2){
            $aniq = $k;
        }
    }
    
    return $url_list[$k];
}

?>