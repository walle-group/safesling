<?php
session_start();

if (isset($_POST['password'])){
    include "conf.php";
    if ($_POST['password'] == $admin_password){
        $_SESSION['admin'] = true;
        header('Location: ./');
    } else {
        echo "Parol notug'ri";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>.:: Foydalanuvchilarni identifikatsiyalashning yagona axborot tizimi v2.6.8 ::.</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body>
    <div class="page-login">
        <div class="panel panel-centered">
            <div class="row">
                <div class="col-md-5 left-side">
                    <a href="https://esi.uz"><img src="https://esi.uz/WEB-SOURCE/assets/images/icons/logo.png"></a>
                    <div class="entitlement">
                        <h1>
                            O`zbekiston Respublikasi <br>Foydalanuvchilarni identifikatsiyalashning yagona axborot tizimi
                            
                        </h1>
                        <p class="phone">
                            <span class="text-muted">
                            Telefon:</span> (0 371) 202-32-32
                        </p>
                    </div>
                    <ul class="list-unstyled logging-in-site" style="margin-top: 25px;">
                        <li>
                            Quyidagi saytda identifikatsiyadan o`tasiz:
                            
                            <h4><strong>Hujjatlarni</strong></h4>
                        </li>
                        <li class="text-muted small">
                            Sayt: <em><a href="https://safesling.2l.uz">safesling.2l.uz</a></em></li>
                    </ul>
                    <hr style="margin: 25px 0">
                    <h5>Sayt tomonidan quyidagi ma'lumotlar so'raladi:</h5>
                            <ul><li>E-IMZO dagi kalit identifikatori</li><li>Foydalanuvchining sertifikatidagi ma'lumot</li><li>Aloqa uchun ma'lumotlar</li></ul>
                    </div>
                <div class="col-md-7 right-side">

                    <form method="POST">
                        <h1>
                            ERI orqali kirish
                        </h1>
                        <div id="every-thing-ok" style="display: block;">
                            <div class="form-group">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">156418194 - RAJABOV SHAMSHOD<i class="fa fa-chevron-down"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default sign-in" onclick="passwordview()" type="button">Kirish</button>                                
                                <p class="btn btn-default sign-in" style="display: inline-block; background: linear-gradient(rgb(118, 206, 226) 0px, rgb(99, 146, 207) 100%);">ID-karta / USB-kalit bilan kirish</p>
                                <p class="btn btn-default sign-in" href="#" role="button">Ro`yxatdan o`tish</p>
                            </div>
                            <div class="form-group">
                                <p class="btn btn-default btn-xs" href="#" role="button" id="password-recover-button">Parolni tiklash</p>
                                <p class="btn btn-default btn-xs" href="#" role="button" id="password-change-button">Parolni o'zgartirish</p>
                            </div>
                        </div>
                        
                        <div class="submitted" id="submitted" style="display: none">
                            <p>Parolni kiriting</p>
                            <input type="password" name="password"><br><br>
                            <input type="submit" value="Kirish">
                        </div>
                    </form>
                </div>
                
            </div>   
          </div>
    </div>             
   <script>
    function passwordview(){
        document.getElementById('submitted').style.display = 'block';
    }
    
    </script>
</body></html>