<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$fpNum=$_GET['fpNum'];
$bkno=$_GET['bkno'];
$vucNo=$_GET['vucNo'];

$sqlB="UPDATE bq_opvchrhdr SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where vouchrno='".$_GET['vucNo']."'";
mysql_query($sqlB);

$sqlB="UPDATE bq_opvchrdtl SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where vouchrno='".$_GET['vucNo']."'";
mysql_query($sqlB);

$sqlB="UPDATE bq_opvchrtaxdtl SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where vouchrno='".$_GET['vucNo']."'";
mysql_query($sqlB);

$sqlB="UPDATE bq_opfpmenuhdr SET ";
$sqlB=$sqlB."vuc_status=''";
$sqlB=$sqlB." where fpno='".$_GET['fpNum']."'";
$UsQuery=mysql_query($sqlB);

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher-details.php?msg='.$_GET['fpNum'].' Cancelled'.'&fromdate='.$curDate.'&todate='.$curDate.'&val=');
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher-details.php?msg=Error in insertion');
}

?>