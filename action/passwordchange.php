<?php

include("../config.php");
$added_on= date('Y-m-d H:i:s');
$suser=$_SESSION['user'];
$error=1;

$sql="SELECT * FROM user WHERE user_name='$suser'";
$result=mysql_query($sql);
$noticia = mysql_fetch_array($result);
$o_pass=$noticia['password'];
$status=$noticia['status'];

if(isset($_POST['npass']))
{
/* 	echo "test".$o_pass."testrr".$_POST['opass'];
	die(); */
  if($o_pass==$_POST['opass'])
  {
	  /* echo "test".$o_pass.$_POST['opass'];
		die(); */
	$sql="UPDATE `user` SET `password` = '".$_POST['npass']."', `reenter_pass` = '".$_POST['cpass']."', `status` = '".$_POST['status']."' WHERE `user_name` = '$suser' ";
	$query=mysql_query($sql);
	if($query)
   {
	$msg=" Password Updated to $suser.";
	$error=0;
	header('location:'.$home_path.'/admin/admin/change-password.php?msg='.$msg); 
	}
	else
	{
	$msg="ERROR in updating ";
	header('location:'.$home_path.'/admin/admin/change-password.php?msg='.$msg); 
	//$error=0;
	}
  }
  else
  {
   $msg=" The Old Password is Incorrect ";
   header('location:'.$home_path.'/admin/admin/change-password.php?msg='.$msg); 
  }
 }

?>