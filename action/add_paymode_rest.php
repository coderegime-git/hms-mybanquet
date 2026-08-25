<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$outlet = isset($_POST['outlet_code']) ? $_POST['outlet_code'] : '';
$payment_types = isset($_POST['payment_type']) ? $_POST['payment_type'] : null;
$access_list = isset($_POST['access']) ? $_POST['access'] : null;

if(!empty($outlet) && is_array($payment_types)){
	for($i=0; $i<count($payment_types); $i++){
		$ptype = $payment_types[$i];
		$acc = $access_list[$i];
		
		$chk = mysql_query("select * from pos_paymode where outlet_code='$outlet' and payment_type='$ptype'");
		if(mysql_num_rows($chk)>0){
			mysql_query("update pos_paymode set access='$acc', added_by='$added_by', added_on='$added_on' where outlet_code='$outlet' and payment_type='$ptype'");
		} else {
			mysql_query("insert into pos_paymode (outlet_code, payment_type, access, added_by, added_on) values ('$outlet', '$ptype', '$acc', '$added_by', '$added_on')");
		}
	}
	header('location:'.$home_path.'/masters/banquet/view_paymode_restriction.php?msg=Data saved successfully!');
} else {
	header('location:'.$home_path.'/masters/banquet/paymode_restriction.php?msg=Error in saving');
}
?>
