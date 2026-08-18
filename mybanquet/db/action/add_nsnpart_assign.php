<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into nsnpart_assign(nsnnumber,nsnname,partnumber,partname,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['nsnnumber']."',";
	$sql.="'".$_POST['nsnname']."',";
	$sql.="'".$_POST['partnumber']."',";
	$sql.="'".$_POST['partname']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/* echo $sql;
die(); */   
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/nsn-partnoassign.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/nsn-partnoassign.php?msg=Error in insertion');
}


?>