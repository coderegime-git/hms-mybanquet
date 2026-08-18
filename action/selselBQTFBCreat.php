<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$bkNo=$_GET['bkNo'];
$bid=$_GET['bid'];

/* echo $bid; */

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$bkNo."' AND hallbook_id='".$bid."'");
$rowb=mysql_fetch_array($sqlb);

$sqlS=mysql_query("select * from bqt_session where sess_code='".$rowb['session']."'");
$rowS=mysql_fetch_array($sqlS);


echo $rowb['guest_name'].','.$rowb['venue'].','.$rowS['sess_name'].','.$rowb['guaranted'].','.$rowb['hall_rate'].','.$rowb['book_date'].','.$bid;

?>