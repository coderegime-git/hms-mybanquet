<?php  
session_start();
include("../config.php");
$userName=$_GET['userName'];
/* echo "fdfdf";
die(); */
$sql="select * from user where user_name='$userName'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$user_id=$row['user_id'];
echo $user_id;
?>