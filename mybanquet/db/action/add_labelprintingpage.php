<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into labelprintingpage(	company_id,label_type,rfq_no,date,dest_code,clin_no,shipment_no,label_qty,tcn_no,	package_type,total_nopieces,piece_no,package_dimension,cu_wt,cu_area,contract_no,nsn_no,cage_code,part_no,part_name,bill_1,bill_2,bill_3,bill_4,ship_1,ship_2,ship_3,ship_4,qup,priority,serial_no,	uid_no,rfid,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['label_type']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['date']."',";
	$sql.="'".$_POST['dest_code']."',";
	$sql.="'".$_POST['clin_no']."',";
	$sql.="'".$_POST['shipment_no']."',";
	$sql.="'".$_POST['label_qty']."',";
	$sql.="'".$_POST['tcn_no']."',";
	$sql.="'".$_POST['package_type']."',";
	$sql.="'".$_POST['total_nopieces']."',";
	$sql.="'".$_POST['piece_no']."',";
	$sql.="'".$_POST['package_dimension']."',";
	$sql.="'".$_POST['cu_wt']."',";
	$sql.="'".$_POST['cu_area']."',";
	$sql.="'".$_POST['contract_no']."',";
	$sql.="'".$_POST['nsn_no']."',";
	$sql.="'".$_POST['cage_code']."',";
	$sql.="'".$_POST['part_no']."',";
	$sql.="'".$_POST['part_name']."',";
	$sql.="'".$_POST['bill_1']."',";
	$sql.="'".$_POST['bill_2']."',";
	$sql.="'".$_POST['bill_3']."',";
	$sql.="'".$_POST['bill_4']."',";
	$sql.="'".$_POST['ship_1']."',";
	$sql.="'".$_POST['ship_2']."',";
	$sql.="'".$_POST['ship_3']."',";
	$sql.="'".$_POST['ship_4']."',";
	$sql.="'".$_POST['qup']."',";
	$sql.="'".$_POST['priority']."',";
	$sql.="'".$_POST['serial_no']."',";
	$sql.="'".$_POST['uid_no']."',";
	$sql.="'".$_POST['rfid']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
die(); */ 
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/operations/labelprintingpage.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/labelprintingpage.php?msg=Error in insertion');
}


?>