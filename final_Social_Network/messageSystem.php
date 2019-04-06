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
?>

<?php 


$sql5 = "SELECT posts.id,
                users.uid,
                posts.userId,
                users.name,
                users.lastname,
                users.username,
                users.image as t,
                posts.body,
                posts.date,
				posts.privateStatus,
                posts.image
                FROM posts INNER JOIN
                users ON posts.userId = users.uid
                WHERE privateStatus='public'  OR 
				posts.userId = users.uid
				ORDER BY posts.id DESC
			";
   
$result = $conn->query($sql5);
$row = $result->fetch_assoc();
$name = $row['name'];
$lname = $row['lastname'];
$user = $row['uid'];
$usern = $row['username'];






?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<style>
		.komentari {
			background-color: red;
			margin: 5px;
		}
	</style>
    </head>
<header>
        <div id="logo">
           <a class="fakebook-logo" href="dashboard.php">Fakebook</a>
       </div>
        <nav>
           <div class="login">
			   <a style="color:black;" class="user-name" href="wall.php?walluser=<?php echo $usern;?>&wallname=<?php echo $name; ?>&walllastname=<?php echo $lname; ?>&id=<?php echo $user; ?>">
                <div class="usernamenav">
                <?php echo $username;?>     
                </div></a>
                <?php echo $imageUserNav; ?>
                
                <a class="logout" href="logout.php">Logout</a>
            </div>
        </nav>
    </header>
	
	
	<body>
		<h1>Send Message:</h1>
		<form action='messageSystem.php' method='POST'>
		<table>
			<tbody>
				<tr>
					<td>To: </td><td><input type='text' name='to' /></td>
				</tr>
				<tr>
					<td></td><td><input type='hidden' name='from' value='<?php echo $username; ?>'/></td>
				</tr>
				<tr>
					<td>Message: </td><td><input type='text' name='message' /></td>
				</tr>
				<tr>
					<td></td><td><input type='submit' value='Send' name='sendMessage' id="sendbutton" /></td>
				</tr>
			</tbody>
		</table>
			
			<h1>My Messages:</h1>
<table>
	<tbody>
		<?php
			//$user = 'username'; //$user = $_SESSION['username'];
			//$qu = mysqli_query($conn, "SELECT * FROM `chat` WHERE `to`='$user'");
			$qu = "SELECT * FROM `chat1` WHERE `to`='$usern'";
			$result1 = $conn->query($qu);
			if ($result1->num_rows > 0) {
				
				while($row = $result1->fetch_assoc()){
					//$message = $row["message"];
					$from = $row["from"];
					
					
echo
<<<HTML
<div class='message'>
<div class='messageFrom'>$from</div>




HTML;
	$qu1 = "SELECT * FROM `chat1` WHERE `from`='$from'";
			$result2 = $conn->query($qu1);
			if ($result2->num_rows > 0) {
				
				while($row2 = $result1->fetch_assoc()){
					$message = $row2["message"];
									
echo
<<<HTML

<div class='poruke'>$message</div>



</div>

HTML;
				}
				}
				}
			}
		?>
	</tbody>
</table>
		</form>
	</body>



<?php
	//$con = mysqli_connect('localhost', 'root', '', 'messagesTutorial') or die(mysql_error());
	if (isSet($_POST['sendMessage'])) {
		if (isSet($_POST['to']) && $_POST['to'] != '' && isSet($_POST['from']) && $_POST['from'] != '' && isSet($_POST['message']) && $_POST['message'] != '') {
			$to = $_POST['to'];
			$from = $_POST['from'];
			$message = $_POST['message'];
			$q = mysqli_query($conn, "INSERT INTO `chat1` VALUES ('', '$message', '$to', '$from')") or die(mysql_error());
			if ($q) {
				echo 'Message sent.';
			}else
				echo 'Failed to send message.';
		}
	}
?>





    
</html>