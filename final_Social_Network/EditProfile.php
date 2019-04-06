
<?php
session_start();

$username = $_SESSION['user'];
$uid = $_SESSION['uid'];
$name = $_SESSION['name'];
$lname = $_SESSION['lastname'];


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
    
    $conn = mysqli_connect(SERVER,USER,PASS,DB);
    mysqli_set_charset($conn,"utf8");
    $sql2 = "SELECT * FROM users WHERE uid = $uid";
    $sql = "SELECT * FROM users AS a INNER JOIN image AS b ON a.uid = b.uid WHERE a.uid = $uid ORDER BY SID DESC";
   
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $row = $result2->fetch_assoc();
    $userimage = $row["image"];
    $userimageprof = $row["image"];
    $imageUser = "<div class='userimg'> <img src='uploads/Profile_Pictures/$userimage'></div>";
    $imageUserProfil = "<div class='userimg'> <img src='uploads/Profile_Pictures/$userimageprof'></div>";
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<title>Profile</title>
	<meta charset="utf-8" />
</head>
<body>

	<header>
       <div id="logo">
           <a class="fakebook-logo" href="dashboard.php">Fakebook</a>
       </div>
        <nav>
           <div id="loginNav">
            <?php echo $imageUser; ?>
            <div class="usernamenav"><?php echo $username; ?></div>
            <a class="logout" href="logout.php">Logout</a>
            </div>
        </nav>
    </header>



<div class="timelineContainer"> 

    <div class="timelineCol">
       <div class="timelineProfileName">
             <?php echo $name." ".$lname; ?>
        </div>
        <form action="EditProfile.php" method="post" enctype="multipart/form-data">
        <div class="timelinePersonalInfo">
            <div class="timelineInfoimage">
                
                <span><?php echo $imageUserProfil; ?></span>
                <input type="file" name="ProfileImageToUpload" id="ProfileImageToUpload">
            </div>
            <div class="timelineInfoNameLastname">
                <span class="timelineLeftInfo">Ime i Prezime:</span>
                <span><?php echo $row['name']. ' ' . $row['lastname'] ?></span>
                <input class="ProfileNameEdit" type='text' name="ProfileNameEdit" value="<?php echo $name ?>" >
                <input class="ProfileLnameEdit" type='text' name="ProfileLnameEdit" value="<?php echo $lname ?>" >
            </div>
            <div class="timelineInfoRowUsername">
                <span class="timelineLeftInfo">Korisničko Ime:</span>
                <span><?php echo $row['username'] ?></span>
                <input class="ProfileUsernameEdit" type='text' name="ProfileUsernameEdit" value="<?php echo $username ?>" >
            </div>
            <div class="timelineInfoRowEmail">
                <span class="timelineLeftInfo">E-mail:</span>
                <span><?php echo $row['email'] ?></span>
            
                
            </div>
            <div>
            <input type="submit" name="profilEdit" value="Edited Post">
            </div>
        </div>
        </form>
    </div>

     </div>
 
<?php
$target_dir = "uploads/Profile_Pictures/";
if(!empty($_FILES["ProfileImageToUpload"]["name"])) {
	$target_name = "_".$username."_".time().".jpg";
} else {
	$target_name = '1';
}


$target_file = $target_dir . $target_name;
	
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
	if(!empty($_FILES["fileToUpload"]["name"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	}
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/

// Check if file already exists


// Check file size
/*if(!empty ($_FILES["fileToUpload"]["size"] > 500000)) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
	}*/

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["ProfileImageToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["ProfileImageToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>




<?php 

if(isset($_POST["profilEdit"])) {
       
        
        $EditName = ($_POST["ProfileNameEdit"]);
        $EditLastname = $_POST["ProfileLnameEdit"];
        $Editimage = $target_name;
        $sqlProfileUpdate = "UPDATE users SET image ='".$Editimage."', name ='".$EditName."', lastname ='".$EditLastname."' WHERE uid ='".$uid."'";
        
        $resultProfileUpdate = $conn->query($sqlProfileUpdate);
        if($resultProfileUpdate === true) {
            echo "Vas status je uspesno updejtovan.";
			header("Location: dashboard.php");
        } else {
            echo "Imate gresku u konekciji " . $conn->error;
        }
      
    }
	$conn->close();
	?>





</body>
</html>