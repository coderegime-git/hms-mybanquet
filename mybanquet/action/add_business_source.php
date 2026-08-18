<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_bssource(bs_code,bs_name,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['bs_code']."',";
	$sql.="'".$_POST['bs_name']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/* 
 echo $sql;
die(); */ 

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/business-source-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/business-source-master.php?msg=Error in insertion');
}


?>