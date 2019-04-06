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
$edit = "";
$delete="";
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

<?php
$target_dir = "uploads/";
if(!empty($_FILES["fileToUpload"]["name"])) {
	$target_name = "_".$username."_".time().".jpg";
} else {
	$target_name = '';
}


$target_file = $target_dir . $target_name;
	
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
//Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>




<?php 

//KOD ZA UNOS PODATAKA U BAZU
    if(!empty($_POST["submit"])) {
       
        
        $postBody = ($_POST["post_body"]);
        $privacy = ($_POST["privacy"]);
		//$fileTo =  ($_FILES["fileToUpload"]);
       
        $fileToUpload = $target_name;
        
        $sqlInsert = "INSERT INTO posts(id, body, date, userId, image, privateStatus) VALUES (null, '".$postBody."', '01-01-2019', '".$uid."', '".$fileToUpload."', '".$privacy."')";
        
        $resultInsert = $conn->query($sqlInsert);
        if($resultInsert === true) {
           // echo "Vas status je uspesno evidentiran.";
        } else {
            echo "Imate gresku u konekciji " . $conn->error;
        }
      
    }

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
    
    <script type="text/javascript">
			function refreshPage(){
				if(confirm("Are you sure, want to refresh?")){
					location.reload();
				}				
			}
		</script>
    
</head>
<body>
    <header>
        <div id="logo">
           <a class="fakebook-logo" href="dashboard.php">Fakebook</a>
       </div>
        <nav>
           <div class="login">
			   <a style="color:black;" class="user-name" href="wall.php?walluser=<?php echo $username;?>&wallname=<?php echo $name; ?>&walllastname=<?php echo $lname; ?>&id=<?php echo $user; ?>">
                <div class="usernamenav">
                <?php echo $username;?>     
                </div></a>
                <?php echo $imageUserNav; ?>
                
                <a class="logout" href="logout.php">Logout</a>
            </div>
        </nav>
    </header>
    
    <section id="content">
        <div class="post">
            <form action="dashboard.php" method="post" enctype="multipart/form-data">
                <div class="status-box">
                    <input class="typeText" type="text" name="post_body" placeholder="Whats on your mind?">
                </div> <br>

                <div class="options-box">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <select class="select" name="privacy">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>

                    <input  class="post-btn" type="submit" name="submit" value="Post">
                </div>
            </form>
        </div>
	<div id="chat-sidebar"> 
    <iframe src="gupchat.php" style="height: 85%; width:100%; border:none;margin:0;padding:2px;"></iframe>
    </div>
        <?php

$sql = "SELECT id, body, date, userId, privateStatus, image FROM posts";
   
$sql2 = "SELECT posts.id,
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
   
$result = $conn->query($sql2);

	
	
	
if ($result->num_rows > 0) {
    // output data of each row
   
    while($row = $result->fetch_assoc()) {
        
        $body = $row["body"];
        $userID = $row["userId"];
        $name = $row["name"];
        $lname = $row['lastname'];
        $usern = $row['username'];
		$private = $row["privateStatus"];
        $image = $row["image"];
        $userimage = $row["t"];
		$postedid = $row["id"];
		$user = $row["uid"];
        $date= $row["date"];
        
        $imageUserProfilePic = "<div class='userimgnav'> <img src='uploads/Profile_Pictures/$userimage'></div>";
        if($uid === $user){
            $edit ="<input class='btn' type='submit' name='postEdit' value='Edit post'>"."<input class='typEditText' type='text' name='postedit' placeholder='$body'>";
            $delete = "<button class='btn' type='submit' name='delete' onClick='window.location.reload()'>Delete</button>";
        }
		
		//Code za ubacivanje videa u post preko textpolja  
    
        $body_array = preg_split("/\s+/", $body);
		foreach($body_array as $key => $value) {

		if(strpos($value, "https://www.youtube.com/watch?v=") !== false) {

					$link = preg_split("!&!", $value);
					$value = preg_replace("!watch\?v=!", "embed/", $link[0]);
					$value = "<iframe class='iframe' src='" . $value ."\'></iframe>";
					$body_array[$key] = $value;
                }
            }
            
        $body = implode(" ", $body_array);
        
        
        if($image !="") {
            $imageDiv = "<div class='postedimg'> <img src='uploads/$image'></div>";
        }
		
         else {
            $imageDiv = "";
        }

		
		
		
$sql3 = "SELECT comments.id,
			comments.post_body,
			comments.posted_by,
			comments.posted_to,
			comments.image,
			posts.id 
			FROM comments INNER JOIN
			posts ON posts.id =comments.posted_to
			where comments.posted_to=$postedid
			ORDER BY posts.id";


		
echo
<<<HTML
   
<div class='post'>
	<div class='dasbordNameImage'>
        $imageUserProfilePic
        <a style="color:black;" class="user-name" href="wall.php?walluser=$usern&wallname=$name&walllastname=$lname&id=$user">$name</a>
	</div>
    <div class='imgpost'>$imageDiv</div>
    <div class='text'>
        <p class="date"> $date</p>
         $body
    </div><br>
	
	
	<br>
	<div class='post_comment' id='Comment1'>
    <form action="dashboard.php"  id="comment" name="postComment" method="POST">
		<textarea class="coment-area" name="coment1" placeholder="Vas komentar..." ></textarea>
        <input type="hidden" name="postid" value="$postedid">
        <div class="comment-box">
            
            <input class="btn" type="submit" name="postComment" value="Komentar" onclick='refreshPage()'>
            $delete
            <form action="dashboard.php"  id="edit" name="postedit" method="POST" enctype="multipart/form-data">
                $edit
    	        <input type="hidden" name="editid" value="$postedid">
	        </form>
        </div>
		</form>
		
		</div>
	
		<div class="container">
        
HTML;
	$result1 = $conn->query($sql3);	
while($row = $result1->fetch_assoc()) {
	$comentbody = $row['post_body'];

if(!empty($comentbody)){
echo
<<<HTML
<div class='coma'>
<div>$imageUserNav</div>
$comentbody</div>
HTML;
}		
}		
echo 
<<<HTML
</div>
</div>

HTML;
$comentbody=""; 

}
	
//fetch_assoc() kupi podatke i smesta u asocijativni niz 
    } else {
        echo "Trenutno nema podataka u bazi.";
    }
?>
	
<?php
 //KOD ZA UNOS PODATAKA U COMENT BAZU
    if(!empty($_POST["postComment"])) {
       
        
        $comentBody = $_POST["coment1"];
        $comentedBy = $userID;
		$comentTo = $_POST["postid"];
        
        $sqlInsert1 = "INSERT INTO comments(id, post_body, posted_by, posted_to, image) VALUES (null, '".$comentBody."', '".$comentedBy."', '".$comentTo."', '1')";
        
        $resultInsert = $conn->query($sqlInsert1);
        if($resultInsert === true) {
           // echo //"Vas status je uspesno evidentiran.";
			header('Location: dashboard.php');
			
        } else {
            echo "Imate gresku u konekciji " . $conn->error;
        }
      
    }
// za brisanje 	
	if(isset($_POST["delete"])) {
	$postidValue = $_POST['postid'];
		
	$sqlDelete="DELETE FROM posts WHERE id = $postidValue AND userId = $uid";
	$resultDelete = $conn->query($sqlDelete); 
	if($resultDelete === true) {
		//echo ("Vas post je uspesno obrisan.");
		//header('Location: dashboard.php');
		header('Refresh: 0; url=dashboard.php');
		//echo '<meta http-dashboard.php="refresh" content="5"/>';
	}else {
		echo ("Ovaj post ne mozete ( odvojeno kako kaze milica ) da obrisete!!!!"). $conn->error;
	}	
}
	
//KOD ZA EDIT PODATAKA U BAZU
if(isset($_POST["postEdit"])) {
 //"UPDATE posts SET body='".$postEdit."' WHERE userId ='".$uid."' AND id = $EditId"      
        
        $postEdit = ($_POST["postedit"]);
        $EditId = $_POST["editid"];
        $sqlUpdate = "UPDATE posts SET body='".$postEdit."' WHERE userId ='".$uid."' AND id = $EditId";
        
        $resultInsertEdit = $conn->query($sqlUpdate);
        if($resultInsertEdit === true) {
            echo "Vas status je uspesno updejtovan.";
			//header("Location:dashboard.php");
        } else {
            echo "Imate gresku u konekciji " . $conn->error;
        }
      
    }
	$conn->close();
	?>
    </section>
    


</body>
  

</html>