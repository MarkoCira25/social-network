<?php 
session_start();
// if(!isset($_SESSION['user']) || !$_SESSION['user'])
if(empty($_SESSION['user'])) {
    header('Location: index.php');
} else {
    //echo $_SESSION['user'];
}

$username = $_SESSION['user'];
$uid = $_SESSION['uid'];
//$usern = $_SESSION['username'];

?>



<?php include("config/config.php"); ?>


<?php

// Create connection
$conn = new mysqli(SERVER, USER, PASS, DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sqlnavimage = "SELECT * FROM users WHERE uid = $uid";
$resultnavimage = $conn->query($sqlnavimage);
$rownavimage = $resultnavimage->fetch_assoc();
$imagenav = $rownavimage['image'];
$imageUserNav = "<div class='userimgnav'> <img src='uploads/Profile_Pictures/$imagenav'></div>";
$user = $rownavimage['username'];
//selektovanje  usera iz uzera tabele
$queryuser = "SELECT username, uid, image FROM users";
$rowtwo = $conn->query($queryuser);
$row2= $rowtwo->fetch_assoc();
$usernamechat = $row2["username"];
$idchat = $row2["uid"];
$imagechate = $row2["image"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>chat box</title>
    <link href="css/style2.css" rel="stylesheet">
    <script>
    function ajax(){
        var req = new XMLHttpRequest();
        
        req.onreadystatechange = function(){
            if(req.readyState == 4 && req.status == 200){
            
            document.getElementById('chat').innerHTML = req.responseText
        }
    }
    
    req.open('GET','chat.php','true');
    req.send();
     }   
    setInterval(function(){ajax},1000);    
    </script>
    </head>
    <body onload="ajax()">
    <div id="container">
        <div id="chatbox">
        <div id="chat">
        </div>
        </div>
        <form action='gupchat.php' method='post'>
            <input type="hidden" name="name" placeholder="Enter name" id="namea" value='<?php echo $username;?>'/>
            <input type="text" name="message" placeholder="enter your massage" id="namea"/>
            <input type="submit" name="submit" value="Send it" id="submita"/>
        </form>
        <?php 
        if(!empty($_POST["submit"])){
            $name = $_POST['name'];
            $message = $_POST['message'];
            
           $queryone ="INSERT INTO chat (name,message) VALUES ('$name', '$message')";
            $run1 =$conn->query($queryone);
            //if($run1 === true){
           //     echo "uaaa";
           // }else {
                //echo "neee";
           // }
        }
        
      
        ?>
    </div>
    
    
    
    
    </body>
</html>