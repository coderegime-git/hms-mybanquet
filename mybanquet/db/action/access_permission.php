<?php
session_start();
include("../config.php");

$user_id=$_POST['user_id'];
$added_on= date('Y-m-d H:i:s');

$i=0;
foreach($_POST['menu_id'] as $menuId)
{
	$i++;
	if($i<sizeof($_POST['menu_id']))
	{
		$menuStr .=$menuId.',';
	}
	else
	{
		$menuStr .=$menuId;
	}
}


$resultacc=mysql_query("select user_name from access_rights where user_name='".$_POST['user_name']."'");
$rowacc=mysql_fetch_array($resultacc);
$userName=$rowacc['user_name'];

if($_POST['user_name']!='' && $_POST['user_name']!=$userName){
	$sql="insert into access_rights(user_id,user_name,menu_id,added_on)";
	$sql.=" values(";
	$sql.="'".$user_id."',";
	$sql.="'".$_POST['user_name']."',";
	$sql.="'".$menuStr."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
die(); */
	$UsQuery =mysql_query($sql);
	
$msg='User access permission successfully added.';	
header('location:'.$home_path.'/admin/access-rights.php?msg='.$msg);
}
if($_POST['user_name']==$userName){
	$msg='User permission already exists. Click on modify button.';
header('location:'.$home_path.'/admin/access-rights.php?msg='.$msg);	
}
 if($_POST['user_name']==''){
$msg='User name should not be blank';
header('location:'.$home_path.'/admin/access-rights.php?msg='.$msg);		
}



?>