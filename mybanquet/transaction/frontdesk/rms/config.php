<?php
	session_start();
$servername = "localhost";  
$username = "root";   
$password = "";
$dbname = "rmsclient";   
$adminconn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($adminconn,"utf8");
$pid = $_SESSION['propid'];
$sql = "SELECT * FROM `cm_propertry` WHERE prod_id='".$pid."'";
$total_pages = $adminconn->query($sql) or die(mysqli_error($conn)); 
$rowss = $total_pages->fetch_assoc();
$servername = "localhost";  
$username = "root";   
$password = "";
$dbname = $rowss['database_name'];    
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");  

$couponid = "SELECT * FROM `res_rmsclient`"; 
$total_pages = $conn->query($couponid) or die(mysqli_error($conn));
$rowLD = $total_pages->fetch_assoc();


$clientid = $rowLD['clientid'];
$clientpassword = $rowLD['clientpassword'];
$agentid = 638;
$agentpassword = "yVv9VLhd5o13Cmc!";
$tykurl =$rowLD['url'];
$trndta = $rowLD['databas'];
$posca = $rowLD['accountid'];
$property = $rowLD['propertyid'];
?>