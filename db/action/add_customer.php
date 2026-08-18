<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into client_master(company_id,client_type,client_code,client_name,contact_person,phone,email,fax,baddress1,baddress2,bcity,bpincode,bstate,bcountry,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['client_type']."',";
	$sql.="'".$_POST['client_code']."',";
	$sql.="'".$_POST['client_name']."',";
	$sql.="'".$_POST['contact_person']."',";
	$sql.="'".$_POST['phone']."',";
	$sql.="'".$_POST['email']."',";
	$sql.="'".$_POST['fax']."',";
	$sql.="'".$_POST['baddress1']."',";
	$sql.="'".$_POST['baddress2']."',";
	$sql.="'".$_POST['bcity']."',";
	$sql.="'".$_POST['bpincode']."',";
	$sql.="'".$_POST['bstate']."',";
	$sql.="'".$_POST['bcountry']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/* echo $sql;
die(); */   
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/customer-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/customer-master.php?msg=Error in insertion');
}


?>