<?php
session_start();
require_once('cabinet/function.php');
if (!is_login()){
    header("Location: login");
    exit;
}

$page = page('adddocument');

if (isset($_GET['name'])){
    $name = $_GET['name'];
    
    $json = json_decode(file_get_contents('https://admin-safesling.2l.uz/api/getdocs?name='.$name), true)['result'];
    
    if ($json){
        $page = page_change('ss_doc_name', $json['name'], $page);
        
        $forma = '';
        foreach ($json as $v){
            if (is_array($v)){
                foreach ($v as $k=>$d){
                    $i++;
                    if ($d['type'] == 'boolean'){
                        $type = "Mantiqiy";
                        $input = '<td><input type="radio" value="1" name="'.$k.'" id="check'.$i.'">
                            <label for="check'.$i.'">Rost</label>
                            <input type="radio" value="0" name="'.$k.'" id="2check'.$i.'">
                            <label for="2check'.$i.'">Yolg\'on</label></td>';
                    } elseif ($d['type'] == 'string'){
                        $type = "Satr";
                        $input = '<td><input type="text" name="'.$k.'"></td>';
                    } else {
                        $type = "Son";
                        $input = '<td><input type="text" name="'.$k.'"></td>';
                    }
                    
                    $forma .= '<tr>
                        <td>'.$d['name'].'</td>
                        <td>'.$type.'</td>
                        '.$input.'
                    </tr>';
                }
            }
        }
        $forma .= "<input type='hidden' name='name' value='$name'>";
        $page = page_change('ss_docinput', $forma, $page);
    } else {
        header("Location: ./");
    }
} else {
    header("Location: ./");
}

$page = page_change('ss_error', $err, $page);

echo $page;
?>