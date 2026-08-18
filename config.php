<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$ippath = 'http://'.$_SERVER['HTTP_HOST'].'/hms';
$home_path='http://'.$_SERVER['HTTP_HOST'].'/mybanquet';
include 'dbconnection.php';
$pid = $_SESSION['propid'];
$sql = "SELECT * FROM `cm_propertry` WHERE prod_id='$pid'";
$total_pages = $adminconn->query($sql) or die(mysqli_error($conn)); 
$rowss = $total_pages->fetch_assoc();

$servername = "localhost";  
$username = $rowss['username'];   
$password = "";
$dbname = $rowss['database_name'];    

define("host5","localhost");
define("user5","root");
define('password5',"");
define('dbname5',$dbname);
$conn = mysql_connect(host,user,password);
mysql_query("SET NAMES UTF8");
mysql_select_db(dbname5,$conn);

?>


