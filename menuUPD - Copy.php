<?php
ob_start();
include("config.php");


$sql=mysql_query("select * from bq_hallbooking where confirm_status='2'");
while($rowR=mysql_fetch_array($sql)){
	
$sUp="UPDATE bq_opbillhdr SET ";
$sUp=$sUp."venue='".$rowR['venue']."',";
$sUp=$sUp."session='".$rowR['session']."'";
$sUp=$sUp." where bkno='".$rowR['booking_no']."'";
$Ud =mysql_query($sUp); 
 

} 






$sqFb=mysql_query("select * from bq_opbillhdr where bill_status!='3'");
while($rmFb=mysql_fetch_array($sqFb)){
	
$sqb=mysql_fetch_array(mysql_query("select hallbook_id,bkno from bq_opfpmenuhdr where fpno='".$rmFb['fpno']."'"));
	
	$sqlLk="UPDATE bq_hallresvadv SET ";
	$sqlLk=$sqlLk."status='2'";
	$sqlLk=$sqlLk." where hallbook_id='".$sqb['hallbook_id']."' AND booking_no='".$sqb['bkno']."' AND status='1'" ;
	$UsQLk =mysql_query($sqlLk);
}




?>