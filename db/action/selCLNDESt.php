<?php  
session_start();
include("../config.php");

$deCode=$_GET['deCode'];
/* echo "select * from client_master where clin_dest='$deCode'"; */
$sqlCl=mysql_query("select * from client_master where clin_dest='$deCode'");
$rowCl=mysql_fetch_array($sqlCl);
	$saddress1=$rowCl['saddress1'];
	$saddress2=$rowCl['saddress2'];
	$scity=$rowCl['scity'];
	
	
$sqlCPo=mysql_query("select * from customer_po where clin_dest='$deCode'");
$rowCPo=mysql_fetch_array($sqlCPo);
$clQty=$rowCPo['clin_qty'];


 echo $saddress1.','.$saddress2.','.$scity.','.$clQty; 
?>








