<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into unsuccessful_quotes(company_id,rfq_no,solic_no,	nsn_no,qty,price,award_whom,award_price,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['solic_no']."',";
	$sql.="'".$_POST['nsn_no']."',";
	$sql.="'".$_POST['qty']."',";
	$sql.="'".$_POST['price']."',";
	$sql.="'".$_POST['award_whom']."',";
	$sql.="'".$_POST['award_price']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
die(); */ 
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/unsuccessfulquotes.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/unsuccessfulquotes.php?msg=Error in insertion');
}


?>