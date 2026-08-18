<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$vucNo=$_GET['vucNo'];

$sqlV=mysql_query("select fpno from bq_opvchrhdr where vouchrno='".$_GET['vucNo']."' AND bill_status='1'");
$rowV=mysql_fetch_array($sqlV);
$fpno=$rowV['fpno'];

$sqlB=mysql_query("select * from bq_opbillhdtl where vouchrno='".$_GET['vucNo']."' AND bill_status='1'");
$rowB=mysql_fetch_array($sqlB);
$bill_no=$rowB['bill_no'];

$sqlB="UPDATE bq_opbillhdr SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where fpno='".$fpno."'";
mysql_query($sqlB);

$sql="UPDATE bq_opbillhdtl SET ";
$sql=$sql."bill_status='3'";
$sql=$sql." where vouchrno='".$vucNo."'";
$UsQuery=mysql_query($sql);

$sql="UPDATE bq_opbilltaxdtl SET ";
$sql=$sql."bill_status='3'";
$sql=$sql." where vouchrno='".$vucNo."'";
$UsQuery=mysql_query($sql);

$sql="UPDATE bq_opbillstldtl SET ";
$sql=$sql."settleflag='3'";
$sql=$sql." where vouchrno='".$vucNo."'";
mysql_query($sql);

/* $sts="";
$sqB="UPDATE bq_hallbooking SET ";
$sqB=$sqB."fp_status='".$sts."'";
$sqB=$sqB." where booking_no='".$_GET['bkno']."'";
$UsQuery=mysql_query($sqB); */
			
if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/bqt_billing.php?vucNo='.$vucNo);
}else {
header('location:'.$home_path.'/transaction/frontdesk/bqt_billing.php?msg=Error in insertion');
}


?>