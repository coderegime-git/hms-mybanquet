<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlB="UPDATE bq_opfpmenuhdr SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where fpno='".$_GET['fpNum']."'";
mysql_query($sqlB);

$sql="UPDATE bq_opfpmenudetail SET ";
$sql=$sql."bill_status='3'";
$sql=$sql." where fpno='".$_GET['fpNum']."'";
mysql_query($sql);


$sts="";
$sqB="UPDATE bq_hallbooking SET ";
$sqB=$sqB."fp_status='".$sts."'";
$sqB=$sqB." where booking_no='".$_GET['bkno']."' and fpno='".$_GET['fpNum']."'";
$UsQuery=mysql_query($sqB);
			
if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fb-creation-chk.php?cmsg='.$_GET['fpNum'].' Cancelled&fpNum='.$_GET['fpNum']);
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fb-creation-chk.php?cmsg=Error in insertion');
}


?>