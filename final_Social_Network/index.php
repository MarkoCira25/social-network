<?php include("config/config.php"); ?>
<?php include("processregister.php"); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Network</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <header>
        <div id="logo">
           <a class="fakebook-logo" href="dashboard.php">Fakebook</a>
       </div>
        <nav>
           <div id="login">
            <form action="processlogin.php" method="post">
                <input class="login__input" type="text" name="usernamelg" placeholder="Korisnicko ime">
                <input class="login__input" type="password" name="passwordlg" placeholder="Lozinka">
                <input class="login__btn" type="submit" name="login" value="Login">
            </form>
            </div>
        </nav>
    </header>
    
    <section>
    <div id="img">
        
    </div>
    <div id="registracija">
       <h2 class="registracija__naslov">Registracija</h2>
        <form action="index.php" method="post">
            <input class="registracija__input" type="text" name="name" placeholder="Unesite ime"> <br>
            <input class="registracija__input" type="text" name="lastname" placeholder="Unesite prezime"> <br>
            <input class="registracija__input" type="email" name="email" placeholder="Unesite email"> <br>
            <input class="registracija__input" type="text" name="username" placeholder="Unesite korisnicko ime"> <br>
            <input class="registracija__input" type="password" name="password" placeholder="Unesite sifru"> <br>
            <input class="registracija__btn" class="registracija__input" type="submit" name="register" placeholder="Registruj">
        </form>
    </div>
    </section>
    
    <?php
    
    if(!empty($_COOKIE["poruka"])) {
        echo $_COOKIE["poruka"];
        unset($_COOKIE["poruka"]);
        setcookie("poruka", "", time()-3600, "/");
    } 
    
    
    ?>
    
    
    <?php 
    
    if($registerMessage) {
        
        echo
            
<<<HTML
<div class="container" style="display: flex; justify-content: flex-end; padding: 20px;">
<div class=""successmessage" style="background-color: green; color: white; padding: 20px; ">
    $registerMessage
    
    <span class="closebtn" style="border: 1px solid white; background-color: grey;">&times;</span>
</div>
</div>
HTML;
    }
    
    ?>
    
<script>
    
var close = document.querySelector('.closebtn');
    close.addEventListener('click', function() {
        this.parentElement.style.opacity = "0";
    })
</script>
    
</body>
</html>