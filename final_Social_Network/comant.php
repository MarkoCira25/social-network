<?php include("config/config.php"); ?>

<?php

// Create connection
$conn = new mysqli(SERVER, USER, PASS, DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>

<html>
<head>
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    
</body>


</html>