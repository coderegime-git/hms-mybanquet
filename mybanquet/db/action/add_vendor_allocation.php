<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$file1 =$_FILES['draw_attach']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/library/"; 
$target_path2 = $upload1 . basename( ($_FILES['draw_attach']['name']));
move_uploaded_file($_FILES['draw_attach']['tmp_name'], $target_path2);
$status='Pending';
$sql="insert into vendor_allocation(company_id,rfq_no,vendor_name,vendor_price,draw_attach,unit_price,qty,allot_qty,unit_issue,total_amount,proceed_po,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['vendor_name']."',";
	$sql.="'".$_POST['vendor_price']."',";
	$sql.="'".$file1."',";
	$sql.="'".$_POST['unit_price']."',";
	$sql.="'".$_POST['qty']."',";
	$sql.="'".$_POST['allot_qty']."',";
	$sql.="'".$_POST['unit_issue']."',";
	$sql.="'".$_POST['total_amount']."',";
	$sql.="'".$_POST['proceed_po']."',";
	$sql.="'".$status."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	
/*  echo $sql;
die();  */

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/vendor_allocation.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/vendor_allocation.php?msg=Error in insertion');
}


?>