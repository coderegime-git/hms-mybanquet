<?php  
session_start();
include("../config.php");
$opass=$_GET['opass'];

$result=mysql_query("select * from user where password='$opass'");
if (mysql_num_rows($result) > 0) {
	echo 1;
}
else{
	echo 0;
}

?>