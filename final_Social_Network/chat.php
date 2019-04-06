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





include("config/config.php"); 




// Create connection
$conn = new mysqli(SERVER, USER, PASS, DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}         





$query = "SELECT * FROM chat ORDER BY id DESC";
            $run = $conn->query($query);
            
            while($row = $run ->fetch_array()) : ?>
            
            <div id="chatdata">
                
                <span style="color:#000000"><?php echo $row['name']; ?>:</span>
				<div class="mesg">
                <span style="padding:0px;margin:0px"><?php echo $row['message']; ?></span>
                <span style="float:right;"><?php echo $row['date']; ?></span>
            	</div>
            </div>
            <?php endwhile; ?>