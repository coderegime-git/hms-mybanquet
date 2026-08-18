<?php  
session_start();
include("../config.php");

$rfq_no=$_GET['rfq_no'];

$sqlCl=mysql_query("select * from vendor_po where rfq_no='$rfq_no'");
$rowCl=mysql_fetch_array($sqlCl);
	$cur_date=$rowCl['cur_date'];
	$vendor_name=$rowCl['vendor_name'];
	$total_amount=$rowCl['total_amount'];
		

echo $cur_date.','.$vendor_name.','.$total_amount;  
?>








