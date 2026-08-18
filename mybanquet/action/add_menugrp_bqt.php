<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_menugrp(menu_code,menu_name,disp_order,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['menu_code']."',";
	$sql.="'".$_POST['menu_name']."',";
	$sql.="'".$_POST['disp_order']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 /* echo $sql;
 die(); */ 
$UsQuery =mysql_query($sql);

 
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/menu_group_bqt.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/menu_group_bqt.php?msg=Error in insertion');
}
	


?>