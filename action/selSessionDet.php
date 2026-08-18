<?php  

include("../config.php");

$sess=$_GET['sess'];
$venu=$_GET['venu'];
$bkDt=$_GET['bkDt'];
$alreadyBooked= false;
$bk=explode('/',$bkDt);
$bkm=@$bk[2].'-'.@$bk[1].'-'.@$bk[0];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];
$adt=explode('/',$curDate);
$adtD=@$adt[2].'-'.@$adt[1].'-'.@$adt[0];
/* echo "select * from bq_hallbooking where venue='".$venu."' AND confirm_status!='7' AND str_to_date(book_date,'%d/%m/%Y') = '$bkm'";	 */	
$sb=mysql_query("select * from bq_hallbooking where venue='".$venu."' AND  confirm_status!='7' AND str_to_date(book_date,'%d/%m/%Y') = '$bkm' and session= '$sess' ");
if(mysql_num_rows($sb)>0){

while($rb=mysql_fetch_array($sb)){
	$starttime = $rb['from_time'];  // your start time
	$endtime = $rb['to_time'];  // End time
	$duration = '60';  // split by 30 mins
	$st=explode(':',$starttime); 
	$str=$st[0];
	$en=explode(':',$endtime); 
	$enr=$en[0];
	
$sEs=(mysql_query("select * from bqt_session where sess_code='".$sess."'"));
while($rsEs=mysql_fetch_array($sEs)){
$frTime=$rsEs['from_time'];
$toTime=$rsEs['to_time'];
$startfrTime = $frTime;
$endtoTime = $toTime;
$duration = '60';
$stF=explode(':',$startfrTime); 
$strF=$stF[0];
$enF=explode(':',$endtoTime); 
$enrF=$enF[0];
	 for($sT=$str;$sT<=$enr;$sT++){ 
		for($stT=$strF;$stT<=$enrF;$stT++){
			 if((int)$sT==(int)$stT){

if($rb['confirm_status']=='2'){
	$sts='Confirmed';
}else if($rb['confirm_status']=='3'){
	$sts='Wait Listed';
}else if($rb['confirm_status']=='4'){
	$sts='Enquiry';
}else if($rb['confirm_status']=='5'){
	$sts='Tentative';
}else if($rb['confirm_status']=='6'){
	$sts='Blocked';
}
/*
if($rb['confirm_status']=='4'){
echo $frTime.','.$toTime;	
}else{
			 
				$msg='Already Booked!. '.'Bk# '.$rb['booking_no'].' Gst name: '.strtoupper($rb['guest_name']).' Status: '.$sts;
				echo '2'.','.$msg;
}	
				*/
				if($rb['confirm_status'] == '2'){

                            $alreadyBooked = true;

                            $msg = "Already Booked!. Bk# ".$rb['booking_no'].
                                   " Gst name: ".strtoupper($rb['guest_name']).
                                   " Status: Confirmed";

                            break 4; // Exit all loops
                        }	
			 } 		
		}	
	} 
  }
}
	if($alreadyBooked){
    echo "2,".$msg;
}else{
    echo $frTime.",".$toTime;
}
}else{
$sqlS=mysql_query("select * from bqt_session where sess_code='".$_GET['sess']."'");
$rowS=mysql_fetch_array($sqlS);
echo $rowS['from_time'].','.$rowS['to_time'];	
}
		


?>