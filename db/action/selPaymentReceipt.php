<?php  
session_start();
include("../config.php");

$ebs_invno=$_GET['ebs_invno'];

$sqlCl=mysql_query("select * from invoice where ebsinv_no='$ebs_invno'");
$rowCl=mysql_fetch_array($sqlCl);
	$invoice_date=$rowCl['invoice_date'];
	$invoice_total=$rowCl['invoice_total'];
		

echo $invoice_date.','.$invoice_total;  
?>








