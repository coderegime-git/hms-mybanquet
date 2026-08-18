<?php  
session_start();
include("../config.php");
$password=$_GET['password'];

$result=mysql_query("select * from user where password='$password'");
if (mysql_num_rows($result) > 0) {
	echo 1;
}
else{
	echo 0;
}

?>