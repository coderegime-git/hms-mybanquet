<?php  
session_start();
include("../config.php");

$clin_dest=$_GET['clin_dest'];

$sqlCl=mysql_query("select * from client_master where clin_dest='$clin_dest'");
$rowCl=mysql_fetch_array($sqlCl);
	$saddress1=$rowCl['saddress1'];
	$saddress2=$rowCl['saddress2'];
	$scity=$rowCl['scity'];
	
$sqlRF=mysql_query("select * from customer_po where clin_dest='$clin_dest'");
$rowRF=mysql_fetch_array($sqlRF);
$clin_qty=$rowRF['clin_qty'];


$sqlPr=mysql_query("select * from property_master where company_id='".$_SESSION['companyId']."'");
$rowPr=mysql_fetch_array($sqlPr);
$baddress1=$rowPr['address1'];
$baddress2=$rowPr['address2'];
$bcity=$rowPr['city'];

echo $clin_qty.','.$saddress1.','.$saddress2.','.$scity.','.$baddress1.','.$baddress2.','.$bcity;  
?>








