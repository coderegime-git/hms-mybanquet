<?php
@session_start();
include("../config.php");
$userName=$_GET['userName'];
echo "hii".$userName;
die();
$sql="select * from user where user_name='$userName'";
$result=mysql_query($sql);
?>