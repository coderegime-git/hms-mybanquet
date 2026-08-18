<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into invoice_payment(company_id,ebsinv_no,inv_date,	inv_amount,payment_amount,payment_type,payment_details,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['ebsinv_no']."',";
	$sql.="'".$_POST['inv_date']."',";
	$sql.="'".$_POST['inv_amount']."',";
	$sql.="'".$_POST['payment_amount']."',";
	$sql.="'".$_POST['payment_type']."',";
	$sql.="'".$_POST['payment_details']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
die(); */ 
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/payment_receipt.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/payment_receipt.php?msg=Error in insertion');
}


?>