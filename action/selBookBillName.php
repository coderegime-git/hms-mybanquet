<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$fpN=$_GET['fpN'];

/* echo "select * from bq_opfpmenuhdr where fpno='".$fpN."' AND bill_status='1'"; */
$sqR=mysql_query("select * from bq_opfpmenuhdr where fpno='".$fpN."' AND bill_status='1'");
$roR=mysql_fetch_array($sqR); 

$sqRb=mysql_query("select * from bq_hallbooking where booking_no='".$roR['bkno']."' AND confirm_status='2' and fpno='".$fpN."'"); 
$rwB=mysql_fetch_array($sqRb);

echo $rwB['booking_no'].'&&'.$rwB['guest_name'].'&&'.$rwB['guaranted'];











?>