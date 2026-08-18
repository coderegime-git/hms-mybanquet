<?php  

include("../config.php");
$added_on= date('Y-m-d H:i:s');

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

/*  echo $menuStr;
die();  */

$resu=mysql_query("select * from user where user_name='".$_POST['user_name']."'");
$rowS=mysql_fetch_array($resu);
$user_id=$rowS['user_id'];


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
/* if($_POST['user_name']==$userName){
	$msg='User permission already exists. Click on modify button.';
header('location:'.$home_path.'/admin/admin/access-rights.php?msg='.$msg);	
} */
 if($_POST['user_name']==''){
$msg='User name should not be blank';
header('location:'.$home_path.'/admin/update-access-rights.php?msg='.$msg);		
}



$result=mysql_query("select * from user where user_name='".$_POST['user_name']."'");
if(mysql_num_rows($result)>0){
$row=mysql_fetch_array($result);
$userId=$row['user_id'];
	if($_POST['user_name']!=''){
		
		$sql="UPDATE access_rights SET ";
		$sql=$sql."user_id='".$userId."',";
		$sql=$sql."user_name='".$_POST['user_name']."',";
		$sql=$sql."menu_id='".$menuStr."',";
		$sql=$sql."added_on='".$added_on."'";
		$sql=$sql." where user_id=".$userId;
	 /*   echo $sql;
		die(); */ 
		$UsQuery =mysql_query($sql);
		
	$msg='User access permission updated successfully';
	header('location:'.$home_path.'/admin/update-access-rights.php?msg='.$msg);
	}
	else{
	$msg='User name should not be blank';
	header('location:'.$home_path.'/admin/update-access-rights.php?msg='.$msg);	
	}
}
?>