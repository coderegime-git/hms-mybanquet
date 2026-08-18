<?php  
session_start();
include("../config.php");
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

$accR=mysql_query("select * from access_rights where user_name='".$_POST['user_name']."'");
if(mysql_num_rows($accR)>0){
		$result=mysql_query("select * from user where user_name='".$_POST['user_name']."'");
		$row=mysql_fetch_array($result);
		$userId=$row['user_id'];
			$sql="UPDATE access_rights SET ";
			$sql=$sql."user_id='".$userId."',";
			$sql=$sql."user_name='".$_POST['user_name']."',";
			$sql=$sql."menu_id='".$menuStr."',";
			$sql=$sql."added_on='".$added_on."'";
			$sql=$sql." where user_id=".$userId;
		/* 	echo $sql;
			die(); */ 
			$UsQuery =mysql_query($sql);
			
		$msg='User access permission updated successfully';
		header('location:'.$home_path.'/admin/update-access-rights.php?msg='.$msg);
}else{
		$result=mysql_query("select * from user where user_name='".$_POST['user_name']."'");
		$row=mysql_fetch_array($result);
		$user_id=$row['user_id'];
		
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
		header('location:'.$home_path.'/admin/update-access-rights.php?msg='.$msg);
		}
}






?>