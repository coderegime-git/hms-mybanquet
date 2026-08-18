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

$sql="insert into pos_session(session_code,session_name,session_order,appl_outlets,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['session_code']."',";
	$sql.="'".strtolower($_POST['session_name'])."',";
	$sql.="'".strtolower($_POST['session_order'])."',";
	$sql.="'".$menuStr."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/* echo $sql;
die(); */   

$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/masters/frontoffice/session-master.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/frontoffice/session-master.php?msg=Error in insertion');
}


?>