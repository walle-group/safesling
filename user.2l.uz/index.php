<?php

if (isset($_GET['docname']) and isset($_GET['id'])){
    $name = $_GET['docname'];
    $id = $_GET['id'];
    
    include "function.php";
    
    $html = check($name, $id);
    
}



?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <dvi class="main">
        <form method="get">
            <input type="text" name="docname" placeholder="hujjat nomi" required>
            <input type="text" name="id" placeholder="id" required>
            <input type="submit" value="Qidirish">
        </form>
        <div class="doc">
            <?=$html?>
        </div>
    </dvi>
</body>
</html>