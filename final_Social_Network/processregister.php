<?php

$registerMessage = false;

if(!empty($_POST['register'])) {
   
   $ok = true;
    
    //provera da li su uneti svi podaci
    
    if(empty($_POST['name'])) {
        $ok = false;
    }
    if(empty($_POST['lastname'])) {
        $ok = false;
    }
    if(empty($_POST['email'])) {
        $ok = false;
    }
    if(empty($_POST['username'])) {
        $ok = false;
    }

    if(empty($_POST['password'])) {
        $ok = false;
    }
    
    if(strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5) {
        $ok = false;
        echo "minimalan broj karaktera je 5";
    }

    
    if($ok == true) {
        $password = $_POST['password'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
       // $imageuser = $_POST['image'];
        $email = $_POST['email'];
        
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        
        // add database code here
        
        $conn = mysqli_connect(SERVER, USER, PASS, DB);
        
        $sql_u = "SELECT * FROM users WHERE username='$username'";
        $res_u = mysqli_query($conn, $sql_u);
        
        if (mysqli_num_rows($res_u) > 0) {
            echo "Username already exists";
        } else {
        
        //SECURITY MEASURES
        
        $escapeName = mysqli_real_escape_string($conn, $name);
        $escapeLastname = mysqli_real_escape_string($conn, $lastname);
        $escapeEmail = mysqli_real_escape_string($conn, $email);
        $escapeUsername = mysqli_real_escape_string($conn, $username);
       // $escapeimage = mysqli_real_escape_string($conn, $imageuser);
        $escapeHash = mysqli_real_escape_string($conn, $hash);
        
        $sql = "INSERT INTO users (name, lastname, email, username, image, password) VALUES ('".$escapeName."',
       '".$escapeLastname."',
       '".$escapeEmail."',
       '".$escapeUsername."',
       '1',
       '".$escapeHash."'
        )";
        
        
        $registerUser = mysqli_query($conn, $sql);

       if($registerUser === true){
           $registerMessage = "User ".$username." added to db";
       } else {
           $registerMessage ="Error description: " . mysqli_error($conn);
       }
        }
       mysqli_close($conn);
   }
 }
?>