<?php
session_start();

$username = $_GET['walluser'];
$uid = $_SESSION['uid'];
$name = $_GET['wallname'];
$lname = $_GET['walllastname'];
include("config/config.php");
//echo "Hello ".$_GET['walluser'];

// Create connection
$conn = new mysqli(SERVER, USER, PASS, DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
<?php
    if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        header('Location: index.php');
      }
    if(!empty($_GET['id'])){
    $user = $_GET['id'];
    }else{
    header('Location: dashboard.php');
    };
    $conn = mysqli_connect(SERVER,USER,PASS,DB);
    mysqli_set_charset($conn,"utf8");
    $sql2 = "SELECT * FROM users WHERE uid = $user";

    $sql = "SELECT * FROM users AS a INNER JOIN image AS b ON a.uid = b.uid WHERE a.uid = $user ORDER BY SID DESC";
    $sql1 = "SELECT * FROM statusi AS a INNER JOIN users AS b on a.uid = b.uid WHERE a.uid = $user ORDER BY TID DESC";
   // $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $row = $result2->fetch_assoc();
	$userimage = $row["image"];
	$name = $row['name'];
	$lname = $row['lastname'];
	$user = $row['uid'];
	$usern = $row['username'];
    $imageUser = "<div class='userimg'> <img class='user-img' src='uploads/Profile_Pictures/$userimage'></div>";
    $profileImg = "<div class='profile-img'> <img class='user-img' src='uploads/Profile_Pictures/$userimage'></div>";
    
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<title>Profile</title>
	<meta charset="utf-8" >
</head>
<body>

	<header>
        <div id="logo">
           <a class="fakebook-logo" href="dashboard.php">Fakebook</a>
       </div>
        <nav>
           <div class="login">
                <div class="usernamenav"><?php echo $username; ?></div> 
                  <?php echo $imageUser; ?>
                <a class="logout" href="logout.php">Logout</a>
            </div>
        </nav>
    </header>


<main class="main">
<div class="timelineContainer"> 

    <div class="timelineCol">
        <div class="timelinePersonalInfo">
            <div class="timelineInfoimage">
                
                <?php echo $profileImg ?>
            </div>
            <div class="timelineInfo">
                <span class="timelineLeftInfo">Ime i Prezime:</span>
                <span><?php echo $row['name']. ' ' . $row['lastname'] ?></span>
            </div>
            <div class="timelineInfo">
                <span class="timelineLeftInfo">Korisničko Ime:</span>
                <span><?php echo $row['username'] ?></span>
            </div>
            <div class="timelineInfo">
                <span class="timelineLeftInfo">E-mail:</span>
                <span><?php echo $row['email'] ?></span>
            </div>
			<div>
			<a href="messageSystem.php"><button  class="btn poruka">Message</button></a>
			</div>
            <div class="editprofil">
            <?php 
            if ($uid === $user) { 
                echo "<a href='EditProfile.php'><button class='btn timelineProfileBtn'>Edit Profile</button></a>";
            }
        ?>
            
            </div>
        </div>

    </div>

 </div>
 

<?php 

$sql3 = "SELECT posts.id,
                users.uid,
                posts.userId,
                users.name,
                users.username,
                users.lastname,
                users.image,
                posts.body,
                posts.privateStatus
                FROM posts INNER JOIN
                users ON posts.userId = users.uid
                WHERE users.username='$username'
                ORDER BY posts.id";
    
$result = $conn->query($sql3);

if ($result->num_rows > 0) {
    // output data of each row
   
    while($row = $result->fetch_assoc()) {
        
        $body = $row["body"];
        $userID = $row["userId"]; 
        $name = $row["name"];
        $userimage = $row["image"];
		
		$body_array = preg_split("/\s+/", $body);
		foreach($body_array as $key => $value) {

		if(strpos($value, "https://www.youtube.com/watch?v=") !== false) {

					$link = preg_split("!&!", $value);
					$value = preg_replace("!watch\?v=!", "embed/", $link[0]);
					$value = "<br><iframe class='iframe'  src='" . $value ."\'></iframe><br>";
					$body_array[$key] = $value;
                }
            }
            
        $body = implode(" ", $body_array);
        
        if($userimage !="") {
            $imageUserDiv = "<div class='postedimg1'> <img src='uploads/Profile_Pictures/$userimage'></div>";
        }
        else {
        $imageUserDiv = "";
    }
        
        echo
<<<HTML

<div class='post post-profile'>
    <div class='dasbordNameImage'>
        $imageUserDiv
         $name
    </div>  
    <div class='text'>$body</div>
</div>

HTML;
    }
//}
    //}
     //fetch_assoc() kupi podatke i smesta u asocijativni niz 
    } else {
        echo "Trenutno nema podataka u bazi.";
    }
$conn->close();

?>

</main>
</body>
</html>