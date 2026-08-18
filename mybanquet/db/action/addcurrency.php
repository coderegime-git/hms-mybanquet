<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql=mysql_query("select * from currency_master where currency_default='".$_POST['currency_default']."'");
if(mysql_num_rows($sql)>0){
	$msg='Currency Default already set';
	header('location:'.$home_path.'/masters/currency-master.php?msg='.$msg);
	
}else{
	$sql="insert into currency_master(company_id,currency_code,currency_desc,conversion_rate,currency_default,status,added_by,added_on) values ('$_SESSION[companyId]','$_POST[currency_code]','$_POST[currency_desc]','$_POST[conversion_rate]','$_POST[currency_default]','$_POST[status]','$added_by','$added_on')";
	$UsQuery =mysql_query($sql);
	if($UsQuery){
		header('location:'.$home_path.'/masters/view-currency-master.php?msg=Data saved Successfully!');
	}
	else{
		header('location:'.$home_path.'/masters/view-currency-master.php?msg=Error in insertion');
	}
}

?>