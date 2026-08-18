<?php  
session_start();
include("../config.php");

$rfq_no=$_GET['rfq_no'];

$sqlCl=mysql_query("select * from quotation where rfq_no='$rfq_no'");
$rowCl=mysql_fetch_array($sqlCl);
	$solicit_number=$rowCl['solicit_number'];
	$nsn_no=$rowCl['nsn_no'];
	$qty=$rowCl['qty'];
	$quote_rate=$rowCl['quote_rate'];
	

echo $solicit_number.','.$nsn_no.','.$qty.','.$quote_rate;  
?>








