<?php  
session_start();
include("../config.php");
$added_on= date('Y-m-d H:i:s');


if($_POST['username']!=''){
	$sql="UPDATE user SET ";
	$sql=$sql."user_name='".$_POST['username']."',";
	$sql=$sql."password='".$_POST['password']."',";
	$sql=$sql."reenter_pass='".$_POST['repass']."',";
	$sql=$sql."email='".$_POST['email']."',";
	$sql=$sql."mobile='".$_POST['mobile']."',";
	$sql=$sql."status='".$_POST['status']."',";
	$sql=$sql."added_on='".$added_on."'";
	$sql=$sql." where user_name='".$_POST['username']."'";
/* 	echo $sql;
	die(); */ 
	$UsQuery =mysql_query($sql);
	header('location:'.$home_path.'/admin/Update-user-master.php?msg=Data updated Successfully!');
}
else{
	header('location:'.$home_path.'/admin/Update-user-master.php?msg=Error in updation');	
}



?>