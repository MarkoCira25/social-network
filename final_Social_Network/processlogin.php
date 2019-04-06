<?php

session_start();
include("config/config.php");

//definisemo varijable

$username = !empty($_POST['usernamelg']);
$password = !empty($_POST['passwordlg']);


//provera da li su prazne

if($username && $password) {
    $db = mysqli_connect(SERVER, USER, PASS, DB);
    
    //promenimo enkodiranje na utf8
    mysqli_set_charset($db, "utf8");
    
    //ubacimo sigurni username unutar sql-a
     
    //SPRINTF() - da ne bismo korstili navodnike - drugi parametar ide na mestu %s u prvom parametru
    $sql = sprintf("SELECT * FROM users WHERE username='%s'",
        mysqli_real_escape_string($db, $_POST['usernamelg'])          
    );
    
    /* moze vise polja da se poredi istovremeno
    $sql = sprintf("SELECT * FROM users WHERE username='%s' or email='%s'",
        mysqli_real_escape_string($db, $_POST['usernamelg']),  mysqli_real_escape_string($db, $_POST['passwordlg'])       
    );
    */
    
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row) {
        $hash = $row['password'];
        
        if(password_verify($_POST['passwordlg'], $hash)) {
            $message = 'Login successful.';
            
            $_SESSION['user'] = $row['username'];
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['image'] = $row['image'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['lastname'] = $row['lastname'];
            
            
            header('Location: dashboard.php');
        } else {
            /*setcookie('loginfail', 'Invalid username/password!', time()+1);
            header('Location: index.php');
            */
            
            
            setcookie("poruka", "pogresna lozinka", time() + (86400), '/');
            header('Location: index.php');
            
        }
    } else {
        echo "Pogresni podaci";
    }
    mysqli_close($db);
} else {
    echo "Niste popunili sva polja";
}


?>