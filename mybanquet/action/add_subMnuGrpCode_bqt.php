<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_submenugrp(submenu_code,submenu_name,subgrp_code,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['submenu_code']."',";
	$sql.="'".$_POST['submenu_name']."',";
	$sql.="'".$_POST['subgrp_code']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 /* echo $sql;
 die(); */ 
$UsQuery =mysql_query($sql);

 
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/submenu_group_bqt.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/submenu_group_bqt.php?msg=Error in insertion');
}
	


?>