<?php  
session_start();
include("../config.php");
$username=$_GET['username'];
$username=str_replace(' ', '', $username);

$result=mysql_query("select * from user where user_name='$username'");
if (mysql_num_rows($result) > 0) {
	echo 1;
}
else{
echo 0;
}

/* 
if($nmRows>0){
	$row=mysql_fetch_array($result);
	$user_id=$row['user_id'];
	$user_name=$row['user_name'];
	$user_name=str_replace(' ', '', $user_name);
		if($username==$user_name){
			echo 1;	
		}else{
			echo 0;		
		} 
} */
?>