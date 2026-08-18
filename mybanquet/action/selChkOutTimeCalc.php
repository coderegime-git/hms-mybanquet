<?php  

include("../config.php");
$gushrs=$_GET['gushrs'];
$mainRmNo=$_GET['mainRmNo'];

$sqlP=mysql_query("select grace_time from property_definition");
$rowp=mysql_fetch_array($sqlP);
$graTime=$rowp['grace_time'];
$calTotHrs=24+$graTime;

$sqlAc=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAc=mysql_fetch_array($sqlAc);
$curDate=$rowAc['cur_date'];

/* echo "select * from guest_trans where room_no='".$mainRmNo."' AND rev_desc='Tariff' AND trans_date='$curDate'";  */ 
$sqlC=mysql_query("select * from guest_trans where room_no='".$mainRmNo."' AND rev_desc='Tariff' AND trans_date='$curDate' AND bill_status='1'");
$nmRows=mysql_num_rows($sqlC);
/* if($nmRows==0 && $gushrs>$calTotHrs){ */
if($nmRows==0 && $gushrs>$calTotHrs){
	echo 1; 
}
else{
	
}
/* $rowC=mysql_fetch_array($sqlC);
$gstCount=$rowC['gstCNT'];

if($gushrs>$calTotHrs && $gstCount==1 ){
	echo 1;
}else{
	
	
} */



?>