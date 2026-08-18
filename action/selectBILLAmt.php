<?php
ob_start();
include("../config.php");

$blno=$_GET['blno'];
$sqlm=mysql_query("select * from bq_opbillhdr where bill_no='".$blno."' and bill_status='1'");
$row=mysql_fetch_array($sqlm);

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."'");
$rowb=mysql_fetch_array($sqlb);

echo $row['fpno'].','.$row['billamt'].','.$row['fname'].','.$rowb['company_name'].','.$rowb['pay_mode'].','.$rowb['booking_no'].','.$row['bill_date']; 
?>