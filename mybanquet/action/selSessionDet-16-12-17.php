<?php  

include("../config.php");

$sess=$_GET['sess'];
$venu=$_GET['venu'];
$bkDt=$_GET['bkDt'];

$bk=explode('/',$bkDt);
$bkm=@$bk[2].'-'.@$bk[1].'-'.@$bk[0];

$sqlb=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') = '$bkm' AND venue='".$venu."' AND session='".$sess."' AND confirm_status='2'");
if(mysql_num_rows($sqlb)>0){
	$rowb=mysql_fetch_array($sqlb);
	$msg='Already Booked!. '.'Bk# '.$rowb['booking_no'].' Gst name: '.strtoupper($rowb['guest_name']);
	
	echo '2'.','.$msg;
}else{
	
$sqlS=mysql_query("select * from bqt_session where sess_code='".$_GET['sess']."'");
$rowS=mysql_fetch_array($sqlS);
echo $rowS['from_time'].','.$rowS['to_time'];

}

?>