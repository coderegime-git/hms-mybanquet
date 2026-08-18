<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

foreach($_POST['option'] as $menuId)
{
	$i++;
	if($i<sizeof($_POST['option']))
	{
		$menuStr .=$menuId.',';
	}
	else
	{
		$menuStr .=$menuId;
	}
}

/* echo $menuStr;
die(); */

$sql="insert into pos_stewart(stew_code,stew_name,outlets,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['stew_code']."',";
	$sql.="'".strtolower($_POST['stew_name'])."',";
	$sql.="'".$menuStr."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/*  echo $sql;
die(); */

$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/masters/frontoffice/stewart-master.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/frontoffice/stewart-master.php?msg=Error in insertion');
}


?>