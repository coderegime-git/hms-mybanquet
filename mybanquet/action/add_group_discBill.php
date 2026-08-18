<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$kot_itemcode=$_POST['kot_itemcode'];


$sql="insert into pos_grpdisc(kot_food,kot_bev,kot_smok,kot_liqr,kot_other,kot_reas,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['kot_food']."',";
	$sql.="'".$_POST['kot_bev']."',";
	$sql.="'".$_POST['kot_smok']."',";
	$sql.="'".$_POST['kot_liqr']."',";
	$sql.="'".$_POST['kot_other']."',";
	$sql.="'".$_POST['kot_reas']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 /* echo $sql;
 die(); */ 
$UsQuery =mysql_query($sql);


if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/billing-screen.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/transaction/frontdesk/billing-screen.php?msg=Error in insertion');
}


?>