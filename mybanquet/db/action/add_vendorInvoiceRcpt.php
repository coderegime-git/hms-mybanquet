<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into vendor_invoicercpt(company_id,rfq_no,vendor_name,vendor_invno,vendor_invdate,	qty_accepted,qty_rework,qty_reject,reason_rework,bal_qty,purorder_no,part_name,	part_no,order_qty,rate,tax,amount,amount_payable,vendor_dlno,vendor_dldate,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['vendor_name']."',";
	$sql.="'".$_POST['vendor_invno']."',";
	$sql.="'".$_POST['vendor_invdate']."',";
	$sql.="'".$_POST['qty_accepted']."',";
	$sql.="'".$_POST['qty_rework']."',";
	$sql.="'".$_POST['qty_reject']."',";
	$sql.="'".$_POST['reason_rework']."',";
	$sql.="'".$_POST['bal_qty']."',";
	$sql.="'".$_POST['purorder_no']."',";
	$sql.="'".$_POST['part_name']."',";
	$sql.="'".$_POST['part_no']."',";
	$sql.="'".$_POST['order_qty']."',";
	$sql.="'".$_POST['rate']."',";
	$sql.="'".$_POST['tax']."',";
	$sql.="'".$_POST['amount']."',";
	$sql.="'".$_POST['amount_payable']."',";
	$sql.="'".$_POST['vendor_dlno']."',";
	$sql.="'".$_POST['vendor_dldate']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	
/* echo $sql;
die();   */

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/vendorinvrecpt.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/vendorinvrecpt.php?msg=Error in insertion');
}


?>