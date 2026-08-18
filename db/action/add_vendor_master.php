<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into vendor_master(company_id,vendor_code,vendor_name,contact_person,contact_number,address1,address2,city,pincode,state,country,phone,email,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['vendor_code']."',";
	$sql.="'".$_POST['vendor_name']."',";
	$sql.="'".$_POST['contact_person']."',";
	$sql.="'".$_POST['contact_number']."',";
	$sql.="'".$_POST['address1']."',";
	$sql.="'".$_POST['address2']."',";
	$sql.="'".$_POST['city']."',";
	$sql.="'".$_POST['pincode']."',";
	$sql.="'".$_POST['state']."',";
	$sql.="'".$_POST['country']."',";
	$sql.="'".$_POST['phone']."',";
	$sql.="'".$_POST['email']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
die();   */
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/view-vendor-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/view-vendor-master.php?msg=Error in insertion');
}


?>