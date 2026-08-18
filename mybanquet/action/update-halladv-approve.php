<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$bookN=$_GET['bookN'];
$status='3';

$sqll="UPDATE bq_hallresvadv SET ";
$sqll=$sqll."booking_no='".$_GET['bookN']."',";
$sqll=$sqll."status='".$status."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where receipt_no='".$_GET['rcptN']."'";
/* echo $sqll;
die(); */ 
$resultt=mysql_query($sqll);

$sqB=mysql_query("select SUM(amount)as ad from bq_hallresvadv where booking_no='".$bookN."' and status='1'");
$rwB=mysql_fetch_array($sqB);
$advV=$rwB['ad'];


$sqlr="UPDATE bq_hallbooking SET ";
$sqlr=$sqlr."adv='".$advV."'";
$sqlr=$sqlr." where booking_no='".$bookN."'";
$Usk =mysql_query($sqlr);

if($resultt){
$msg='BK No.'.$bookN.' advance Cancelled.';
header('location:'.$home_path.'/transaction/frontdesk/view-halladvance-booking.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/transaction/frontdesk/view-halladvance-booking.php?msg='.$msg);	
}

?>