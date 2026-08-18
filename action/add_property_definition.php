<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into property_definition(prop_code,prop_name,address1,address2,city,pin_code,country,state,phone,email,tin_number,service_tax,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".strtoupper($_POST['prop_code'])."',";
	$sql.="'".$_POST['prop_name']."',";
	$sql.="'".$_POST['address1']."',";
	$sql.="'".$_POST['address2']."',";
	$sql.="'".$_POST['city']."',";
	$sql.="'".$_POST['pin_code']."',";
	$sql.="'".$_POST['country']."',";
	$sql.="'".$_POST['state']."',";
	$sql.="'".$_POST['phone']."',";
	$sql.="'".$_POST['email']."',";
	$sql.="'".$_POST['tin_number']."',";
	$sql.="'".$_POST['service_tax']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/* echo $sql;
die(); */

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/frontoffice/property-definition.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/frontoffice/property-definition.php?msg=Error in insertion');
}


?>