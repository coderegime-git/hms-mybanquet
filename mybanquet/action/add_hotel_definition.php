<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into property_definition(prop_code,prop_name,address1,address2,city,pin_code,country,state,phone,email,tin_number,service_tax,luxury_tax,billing,pre_text,round_off,rnd_value,base_curr,checkout_time,grace_time,early_checkin,room_type,rack_table,market_segment,business_src,meal_plan,pay_mode,financial_year,val_decimal,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['prop_code']."',";
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
	$sql.="'".$_POST['luxury_tax']."',";
	$sql.="'".$_POST['billing']."',";
	$sql.="'".$_POST['pre_text']."',";
	$sql.="'".$_POST['round_off']."',";
	$sql.="'".$_POST['rnd_value']."',";
	$sql.="'".$_POST['base_curr']."',";
	$sql.="'".$_POST['checkout_time']."',";
	$sql.="'".$_POST['grace_time']."',";
	$sql.="'".$_POST['early_checkin']."',";
	$sql.="'".$_POST['room_type']."',";
	$sql.="'".$_POST['rack_table']."',";
	$sql.="'".$_POST['market_segment']."',";
	$sql.="'".$_POST['business_src']."',";
	$sql.="'".$_POST['meal_plan']."',";
	$sql.="'".$_POST['pay_mode']."',";
	$sql.="'".$_POST['financial_year']."',";
	$sql.="'".$_POST['val_decimal']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

 echo $sql;
die(); 

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/frontoffice/hotel-definition.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/frontoffice/hotel-definition.php?msg=Error in insertion');
}


?>