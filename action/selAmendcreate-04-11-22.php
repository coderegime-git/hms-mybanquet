<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$bkNo=$_GET['bkNo'];
$fbn=$_GET['fbn'];

/* echo $bid; */

$sqlb=mysql_query("select * from bq_opfpmenuhdr where fpno='".$fbn."'");
$rowb=mysql_fetch_array($sqlb);

$sqlS=mysql_query("select * from bq_hallbooking where booking_no='".$bkNo."' and fpno='".$fbn."' ");
$rowS=mysql_fetch_array($sqlS);

echo $rowb['fpno'].'&#'.$rowS['booking_no'].'&#'.$rowS['guest_name'].'&#'.$rowS['venue'].'&#'.$rowS['session'].'&#'.$rowS['from_time'].'&#'.$rowS['to_time'].'&#'.$rowS['funct'].'&#'.$rowS['seating'].'&#'.$rowS['book_date'].'&#'.$rowS['guaranted'].'&#'.$rowS['expected'].'&#'.$rowb['hallchrg'].'&#'.$rowb['ratechrg'].'&#'.$rowS['booked_by'].'&#'.$rowb['remarks'].'&#'.$rowb['halltax'].'&#'.$rowb['ratetax'].'&#'.$rowb['hallbook_id'].'&#'.$rowb['signboard'].'&#'.$rowb['arrtime'].'&#'.$rowb['pictime'].'&#'.$rowb['sertime'].'&#'.$rowb['evetea'].'&#'.$rowb['mortea'].'&#'.$rowb['menu_code'].'&#'.$rowb['hallincl'].'&#'.$rowb['rateincl'];

?>