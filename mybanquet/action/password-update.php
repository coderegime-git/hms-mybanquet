<?php

include("../config.php");
$added_on= date('Y-m-d H:i:s');
$error=1;
$suser=$_POST['user_id'];
$username=$_POST['username'];

$sql="SELECT * FROM user WHERE user_name='$username'";
$result=mysql_query($sql);
$noticia = mysql_fetch_array($result);
$o_pass=$noticia['password'];
$userName=$noticia['user_name'];
$status=$noticia['status'];

if(isset($_POST['npass']))
{
  if($o_pass==$_POST['opass'])
  {
	if($_SESSION['user']=='admin'){
	$sql="UPDATE `user` SET `password` = '".$_POST['npass']."', `reenter_pass` = '".$_POST['cpass']."', `status` = '".$_POST['status']."' WHERE `user_name` = '$userName' ";
	}
	if($_SESSION['user']!='admin'){
	$sql="UPDATE `user` SET `password` = '".$_POST['npass']."', `reenter_pass` = '".$_POST['cpass']."' WHERE `user_name` = '$userName' ";
	}
	
	$query=mysql_query($sql);
	if($query)
   {
	$msg=" Password Updated to $userName.";
	$error=0;
	header('location:'.$home_path.'/admin/update-password.php?msg='.$msg); 
	}
	else
	{
	$msg="ERROR in updating ";
	header('location:'.$home_path.'/admin/update-password.php?msg='.$msg); 
	//$error=0;
	}
  }
  else
  {
   $msg=" The Old Password is Incorrect ";
   header('location:'.$home_path.'/admin/update-password.php?msg='.$msg); 
  }
 }

?>