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
   $array_of_time[] = date ("h", $start_time);
   $start_time += $add_mins; // to check endtie=me
}
}
}

for($cd=0;$cd<count($array_of_time);$cd++){
	
$sT= $array_of_time[$cd];
echo $sT;
if($sT=='06'){$tmS6='06';}
if($sT=='07'){$tmS7='07';}
if($sT=='08'){$tmS8='08';}
if($sT=='09'){$tmS9='09';}
if($sT=='10'){$tmS10='10';}
if($sT=='11'){$tmS11='11';}
if($sT=='12'){$tmS12='12';}
if($sT=='13'){$tmS13='13';}
if($sT=='14'){$tmS14='14';}
if($sT=='15'){$tmS15='15';}
if($sT=='16'){$tmS16='16';}
if($sT=='17'){$tmS17='17';}
if($sT=='18'){$tmS18='18';}
if($sT=='19'){$tmS19='19';}
if($sT=='20'){$tmS20='20';}
if($sT=='21'){$tmS21='21';}
if($sT=='22'){$tmS22='22';}
if($sT=='23'){$tmS23='23';}
if($sT=='24'){$tmS24='24';}


if($cd==0){

$sqlAR="insert into  bq_dashhallbook(book_date,venue,session,from_time,to_time,tme6,tme7,tme8,tme9,tme10,tme11,tme12,tme13,tme14,tme15,tme16,tme17,tme18,tme19,tme20,tme21,tme22,tme23,tme24,status,added_by,added_on)";
		$sqlAR.=" values(";
		
		$sqlAR.="'".$_POST['book_date'][$cd]."',";
		$sqlAR.="'".$_POST['venue'][$cd]."',";
		$sqlAR.="'".$_POST['session'][$cd]."',";
		$sqlAR.="'".$_POST['from_time'][$cd]."',";
		$sqlAR.="'".$_POST['to_time'][$cd]."',";
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
		$UsQueCy =mysql_query($sqlAR); 
		
		$reg_id = mysql_insert_id();
}


/* if($tmS6>0){
	$sqll="UPDATE bq_dashhallbook SET ";
	$sqll=$sqll."tme6='".$tmS6."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where dash_id='".$reg_id."'";
	$resultt=mysql_query($sqll);
}
if($tmS7>0){
	$sqll="UPDATE bq_dashhallbook SET ";
	$sqll=$sqll."tme7='".$tmS7."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where dash_id='".$reg_id."'";
	$resultt=mysql_query($sqll);
}
if($tmS8>0){
	$sqll="UPDATE bq_dashhallbook SET ";
	$sqll=$sqll."tme8='".$tmS8."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where dash_id='".$reg_id."'";
	$resultt=mysql_query($sqll);
} */

$sqll="UPDATE bq_dashhallbook SET ";
$sqll=$sqll."tme6='".$tmS6."',";
$sqll=$sqll."tme7='".$tmS7."',";
$sqll=$sqll."tme8='".$tmS8."',";
$sqll=$sqll."tme9='".$tmS9."',";
$sqll=$sqll."tme10='".$tmS10."',";
$sqll=$sqll."tme11='".$tmS11."',";
$sqll=$sqll."tme12='".$tmS12."',";
$sqll=$sqll."tme13='".$tmS13."',";
$sqll=$sqll."tme14='".$tmS14."',";
$sqll=$sqll."tme15='".$tmS15."',";
$sqll=$sqll."tme16='".$tmS16."',";
$sqll=$sqll."tme17='".$tmS17."',";
$sqll=$sqll."tme18='".$tmS18."',";
$sqll=$sqll."tme19='".$tmS19."',";
$sqll=$sqll."tme20='".$tmS20."',";
$sqll=$sqll."tme21='".$tmS21."',";
$sqll=$sqll."tme22='".$tmS22."',";
$sqll=$sqll."tme23='".$tmS23."',";
$sqll=$sqll."tme24='".$tmS24."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where dash_id='".$reg_id."'";

$resultt=mysql_query($sqll);



	
}

 die(); 












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
	
		 $UsQueCy =mysql_query($sqlAR); 
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