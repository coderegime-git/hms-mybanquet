<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sql="insert into pos_itembar(baritem_code,baritem_name,baritem_uom,conv_factor,	category,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['baritem_code']."',";
	$sql.="'".$_POST['baritem_name']."',";
	$sql.="'".$_POST['baritem_uom']."',";
	$sql.="'".$_POST['conv_factor']."',";
	$sql.="'".$_POST['category']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	 /* echo $sql; 
	 die(); */ 
$UsQuery =mysql_query($sql);


if($UsQuery){
		header('location:'.$home_path.'/masters/frontoffice/item-masterbar.php?msg=Data saved Successfully!');
	}
	else{
		header('location:'.$home_path.'/masters/frontoffice/item-masterbar.php?msg=Error in insertion');
	}
	


?>