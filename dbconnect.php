<?php
session_start();
include 'dbconnection.php';

$pid = $_SESSION['propid'];
//$pid = '1';
//echo $pid;
$sql = "SELECT * FROM `cm_propertry` WHERE prod_id='$pid'";
$total_pages = $adminconn->query($sql) or die(mysqli_error($conn)); 
$rowss = $total_pages->fetch_assoc();

$servername = "localhost";  
$username = $rowss['username'];   
$password = "";
$dbname = $rowss['database_name'];    
//$conn = new mysqli($servername, $username, $password, $dbname);
//mysqli_set_charset($conn,"utf8"); 

define("host3","localhost");
define("user3","root");
define('password3',"");
define('dbname3',$dbname);
$conn = mysql_connect(host3,user3,password3);
mysql_query("SET NAMES UTF8");
mysql_select_db(dbname3,$conn);


$home_path='http://'.$_SERVER['HTTP_HOST'].'/hms';

$connection_1 = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db($dbname, $connection_1) or die(mysql_error()); 

$connection_2 = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db($dbname, $connection_2) or die(mysql_error());

$servername = "localhost";  
$username = "root";   
$password = "";
$dbname = $rowss['database_name'];    
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8"); 

$servername = "localhost";    
$username = "root";   
$password = "";
$dbname = $rowss['database_name'];    
$connpos = new mysqli($servername, $username, $password, $dbname);


$servername = "localhost";  
$username = "root";   
$password = "";
$dbnames = $rowss['database_name'];    
$connstore = new mysqli($servername, $username, $password, $dbnames);
?>