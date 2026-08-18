<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$book_date=$_POST['book_date'];



for($cc=0;$cc<count($_POST['from_time']);$cc++){
	if($_POST['from_time'][$cc]!=''){
	
$starttime = $_POST['from_time'][$cc];  // your start time
$endtime = $_POST['to_time'][$cc];  // End time
$duration = '60';  // split by 30 mins
 
$array_of_time = array ();
$start_time    = strtotime ($starttime); //change to strtotime
$end_time      = strtotime ($endtime); //change to strtotime
 
$add_mins  = $duration * 60;
 
while ($start_time <= $end_time) // loop between time
{
   /* $array_of_time[] = date ("h:i", $start_time); */
   $array_of_time[] =','. date ("h", $start_time);
   $start_time += $add_mins; // to check endtie=me
}
}
}

for($cd=0;$cd<count($array_of_time);$cd++){

$sT= $array_of_time[$cd];

if($sT=='06'){$tmS6='06';}else{$tmS6='';}
if($sT=='07'){$tmS7='07';}else{$tmS7='';}
if($sT=='08'){$tmS8='08';}else{$tmS8='';}
if($sT=='09'){$tmS9='09';}else{$tmS9='';}
if($sT=='10'){$tmS10='10';}else{$tmS10='';}
if($sT=='11'){$tmS11='11';}else{$tmS11='';}
if($sT=='12'){$tmS12='12';}else{$tmS12='';}
if($sT=='13'){$tmS13='13';}else{$tmS13='';}
if($sT=='14'){$tmS14='14';}else{$tmS14='';}
if($sT=='15'){$tmS15='15';}else{$tmS15='';}
if($sT=='16'){$tmS16='16';}else{$tmS16='';}
if($sT=='17'){$tmS17='17';}else{$tmS17='';}
if($sT=='18'){$tmS18='18';}else{$tmS18='';}
if($sT=='19'){$tmS19='19';}else{$tmS19='';}
if($sT=='20'){$tmS20='20';}else{$tmS20='';}
if($sT=='21'){$tmS21='21';}else{$tmS21='';}
if($sT=='22'){$tmS22='22';}else{$tmS22='';}
if($sT=='23'){$tmS23='23';}else{$tmS23='';}
if($sT=='24'){$tmS24='24';}else{$tmS24='';}
$sqlAR="insert into  bq_dashhallbook(book_date,venue,session,from_time,to_time,tme6,tme7,tme8,tme9,tme10,tme11,tme12,tme13,tme14,tme15,tme16,tme17,tme18,tme19,tme20,tme21,tme22,tme23,tme24,status,added_by,added_on)";
		$sqlAR.=" values(";
		
		$sqlAR.="'".$_POST['book_date'][$cc]."',";
		$sqlAR.="'".$_POST['venue'][$cc]."',";
		$sqlAR.="'".$_POST['session'][$cc]."',";
		$sqlAR.="'".$_POST['from_time'][$cc]."',";
		$sqlAR.="'".$_POST['to_time'][$cc]."',";
		 $sqlAR.=implode('', $array_of_time);
       $sqlAR.=")";
	   echo $sqlAR;
	   die();
		mysql_query($sqlAR);
		$sqlAR.="'".$tmS6."',";
		$sqlAR.="'".$tmS7."',";
		$sqlAR.="'".$tmS8."',";
		$sqlAR.="'".$tmS9."',";
		$sqlAR.="'".$tmS10."',";
		$sqlAR.="'".$tmS11."',";
		$sqlAR.="'".$tmS12."',";
		$sqlAR.="'".$tmS13."',";
		$sqlAR.="'".$tmS14."',";
		$sqlAR.="'".$tmS15."',";
		$sqlAR.="'".$tmS16."',";
		$sqlAR.="'".$tmS17."',";
		$sqlAR.="'".$tmS18."',";
		$sqlAR.="'".$tmS19."',";
		$sqlAR.="'".$tmS20."',";
		$sqlAR.="'".$tmS21."',";
		$sqlAR.="'".$tmS22."',";
		$sqlAR.="'".$tmS23."',";
		$sqlAR.="'".$tmS24."',";
		$sqlAR.="'1',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
	/* echo  $sqlAR;
	die(); */

		$UsQueCy =mysql_query($sqlAR); 
		
		
}














for( $cc=0; $cc<count($book_date); $cc++ ){
	if($_POST['book_date'][$cc]!=''){
		$sqlAR="insert into  bq_hallbooking(book_date,venue,session,from_time,to_time,seating,funct,expected,guaranted,hall_rate,confirm_status,chief_guest,corporate,title,guest_name,address1,address2,city,country,phone,email,company_name,comaddress1,comaddress2,comcity,comphone,comemail,booker_name,booker_no,top_code,business_src,segment_code,purpose_visit,pay_mode,remarks,added_by,added_on)";
		$sqlAR.=" values(";
		$sqlAR.="'".$_POST['book_date'][$cc]."',";
		$sqlAR.="'".$_POST['venue'][$cc]."',";
		$sqlAR.="'".$_POST['session'][$cc]."',";
		$sqlAR.="'".$_POST['from_time'][$cc]."',";
		$sqlAR.="'".$_POST['to_time'][$cc]."',";
		$sqlAR.="'".$_POST['seating'][$cc]."',";
		$sqlAR.="'".$_POST['funct'][$cc]."',";
		$sqlAR.="'".$_POST['expected'][$cc]."',";
		$sqlAR.="'".$_POST['guaranted'][$cc]."',";
		$sqlAR.="'".$_POST['hall_rate'][$cc]."',";
		$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
		$sqlAR.="'".$_POST['chief_guest'][$cc]."',";
		$sqlAR.="'".$_POST['corporate']."',";
		$sqlAR.="'".$_POST['title']."',";
		$sqlAR.="'".$_POST['guest_name']."',";
		$sqlAR.="'".$_POST['address1']."',";
		$sqlAR.="'".$_POST['address2']."',";
		$sqlAR.="'".$_POST['city']."',";
		$sqlAR.="'".$_POST['country']."',";
		$sqlAR.="'".$_POST['phone']."',";
		$sqlAR.="'".$_POST['email']."',";
		$sqlAR.="'".$_POST['company_name']."',";
		$sqlAR.="'".$_POST['comaddress1']."',";
		$sqlAR.="'".$_POST['comaddress2']."',";
		$sqlAR.="'".$_POST['comcity']."',";
		$sqlAR.="'".$_POST['comphone']."',";
		$sqlAR.="'".$_POST['comemail']."',";
		$sqlAR.="'".$_POST['booker_name']."',";
		$sqlAR.="'".$_POST['booker_no']."',";
		$sqlAR.="'".$_POST['top_code']."',";
		$sqlAR.="'".$_POST['business_src']."',";
		$sqlAR.="'".$_POST['segment_code']."',";
		$sqlAR.="'Null',";
		$sqlAR.="'".$_POST['pay_mode']."',";
		$sqlAR.="'".$_POST['remarks']."',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		/* echo $sqlAR; */ 
	
		/* $UsQueCy =mysql_query($sqlAR);  */
	}
}
	/* die(); */

	
if($UsQueCy){
		header('location:'.$home_path.'/transaction/frontdesk/hall-booking.php?msg= generated successfully!.');
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/hall-booking.php?msg=Error in insertion');
	}	
?>