<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
if($_POST['typo_po']=='purchase order'){
	$prefix=$_POST['prefixpo'];
	$poNumber=$_POST['po_no'];
}
if($_POST['typo_po']=='job order'){
	$prefix=$_POST['prefixjo'];
	$poNumber=$_POST['jo_no'];
}
if($_POST['nowLat']=='now'){
	$nowLater='completed';
}else{
	$nowLater='pending';
}


$sql="insert into vendor_po(	company_id,typo_po,rfq_no,vendor_name,vend_add1,vend_add2,vend_city,vend_pincode,cur_date,qty,quote_qty,bal_qty,unit_issue,currency,rate,req_deldate,custreq_deldate,prefix,po_no,part_no,part_name,total_amount,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['typo_po']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['vendor_name']."',";
	$sql.="'".$_POST['vend_add1']."',";
	$sql.="'".$_POST['vend_add2']."',";
	$sql.="'".$_POST['vend_city']."',";
	$sql.="'".$_POST['vend_pincode']."',";
	$sql.="'".$_POST['cur_date']."',";
	$sql.="'".$_POST['qty']."',";
	$sql.="'".$_POST['quote_qty']."',";
	$sql.="'".$_POST['bal_qty']."',";
	$sql.="'".$_POST['unit_issue']."',";
	$sql.="'".$_POST['currency']."',";
	$sql.="'".$_POST['rate']."',";
	$sql.="'".$_POST['req_deldate']."',";
	$sql.="'".$_POST['custreq_deldate']."',";
	$sql.="'".$prefix."',";
	$sql.="'".$poNumber."',";
	$sql.="'".$_POST['part_no']."',";
	$sql.="'".$_POST['part_name']."',";
	$sql.="'".$_POST['total_amount']."',";
	$sql.="'".$nowLater."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	
/*  echo $sql;
die(); */

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/vendorpo.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/vendorpo.php?msg=Error in insertion');
}


?>