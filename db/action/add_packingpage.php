<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into packingpage(company_id,rfq_no,clin_no,packing_date,contract_no,nsn_no,part_no,	part_name,total_qty,clin_qty,dest_code,dest_address,packing_req,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['clin_no']."',";
	$sql.="'".$_POST['packing_date']."',";
	$sql.="'".$_POST['contract_no']."',";
	$sql.="'".$_POST['nsn_no']."',";
	$sql.="'".$_POST['part_no']."',";
	$sql.="'".$_POST['part_name']."',";
	$sql.="'".$_POST['total_qty']."',";
	$sql.="'".$_POST['clin_qty']."',";
	$sql.="'".$_POST['dest_code']."',";
	$sql.="'".$_POST['dest_address']."',";
	$sql.="'".$_POST['packing_req']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/* echo $sql;
die(); */   
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/packingpage.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/packingpage.php?msg=Error in insertion');
}


?>