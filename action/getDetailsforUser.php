<?php  

include("../config.php");
$userName=$_GET['user_namem'];

$sql="select * from user where user_name='$userName'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$user_id=$row['user_id'];
$email=$row['email'];
$mobile=$row['mobile'];
echo $user_id.','.$email.','.$mobile;
?>