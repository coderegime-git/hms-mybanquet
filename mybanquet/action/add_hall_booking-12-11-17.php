<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$book_date=$_POST['book_date'];


/* Start Dash Hall insert */

$sqlS=mysql_query("select * from bq_gennextvalue where field='bookno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$bookNo=$rowS['currvalue']+1;
$bookNum=$prefix.$bookNo;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];









/* Start Hall Booking */
for( $cc=0; $cc<count($book_date); $cc++ ){
	if($_POST['book_date'][$cc]!=''){
		$adv="";
		$sts="";
		$sqlAR="insert into  bq_hallbooking(audit_date,book_date,booking_no,venue,session,from_time,to_time,seating,funct,expected,guaranted,hall_rate,confirm_status,fp_status,chief_guest,corporate,title,guest_name,address1,address2,city,pin, 	state,country,phone,email,comp_code,company_name,comaddress1,comaddress2,comcity,compin,comstate,comcountry,comphone,comemail,contact_person,contact_mobile,booked_by,booker_id,top_code,business_src,segment_code,purpose_visit,pay_mode,remind_date,remarks,adv,added_by,added_on)";
		$sqlAR.=" values(";
		$sqlAR.="'".$curDate."',";
		$sqlAR.="'".$_POST['book_date'][$cc]."',";
		$sqlAR.="'".$bookNum."',";
		$sqlAR.="'".$_POST['venue'][$cc]."',";
		$sqlAR.="'".$_POST['session'][$cc]."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['from_time'][$cc])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['to_time'][$cc])."',";
		$sqlAR.="'".$_POST['seating'][$cc]."',";
		$sqlAR.="'".$_POST['funct'][$cc]."',";
		$sqlAR.="'".$_POST['expected'][$cc]."',";
		$sqlAR.="'".$_POST['guaranted'][$cc]."',";
		$sqlAR.="'".$_POST['hall_rate'][$cc]."',";
		$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
		$sqlAR.="'".$sts."',";
		$sqlAR.="'".$_POST['chief_guest'][$cc]."',";
		$sqlAR.="'".$_POST['corporate']."',";
		$sqlAR.="'".$_POST['title']."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['guest_name'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['address1'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['address2'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['city'])."',";
		$sqlAR.="'".$_POST['pin_code']."',";
		$sqlAR.="'".$_POST['state']."',";
		$sqlAR.="'".$_POST['country']."',";
		$sqlAR.="'".$_POST['phone']."',";
		$sqlAR.="'".$_POST['email']."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['comp_code'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['company_name'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['comaddress1'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['comaddress2'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['comcity'])."',";
		$sqlAR.="'".$_POST['compincode']."',";
		$sqlAR.="'".$_POST['comstate']."',";
		$sqlAR.="'".$_POST['comcountry']."',";
		$sqlAR.="'".$_POST['comphone']."',";
		$sqlAR.="'".$_POST['comemail']."',";
		$sqlAR.="'".$_POST['contact_person']."',";
		$sqlAR.="'".$_POST['contact_mobile']."',";
		$sqlAR.="'".$_POST['booked_by']."',";
		$sqlAR.="'".$_POST['booker_id']."',";
		$sqlAR.="'".$_POST['top_code']."',";
		$sqlAR.="'".$_POST['business_src']."',";
		$sqlAR.="'".$_POST['segment_code']."',";
		$sqlAR.="'Null',";
		$sqlAR.="'".$_POST['pay_mode']."',";
		$sqlAR.="'".$_POST['remind_date']."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['remarks'])."',";
		$sqlAR.="'".$adv."',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		  /* echo $sqlAR; 
		 die(); */
		$UsQueCy =mysql_query($sqlAR); 
		 
		 $reg_id = mysql_insert_id();
		 
		 
	$bokD=$_POST['book_date'][$cc];
	$fr=explode('/',$bokD);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	
		$starttime = $_POST['from_time'][$cc];  // your start time
		$endtime = $_POST['to_time'][$cc];  // End time
		$duration = '60';  // split by 30 mins
		$st=explode(':',$starttime); 
		$str=$st[0];
		$en=explode(':',$endtime); 
		$enr=$en[0];
		
		for($sT=$str;$sT<=$enr;$sT++){
				/* echo $sT; */
				$sqAR="insert into bq_dashhall(audit_date,funtion_date,booking_no,hallbook_id,guest_name,venue,session,from_time,to_time,hour,confirm_status,status,added_by,added_on)";
						$sqAR.=" values(";
						$sqAR.="'".$curDate."',";
						$sqAR.="'".$_POST['book_date'][$cc]."',";
						$sqAR.="'".$bookNum."',";
						$sqAR.="'".$reg_id."',";
						$sqAR.="'".mysql_real_escape_string($_POST['guest_name'])."',";
						$sqAR.="'".mysql_real_escape_string($_POST['venue'][$cc])."',";
						$sqAR.="'".$_POST['session'][$cc]."',";
						$sqAR.="'".$_POST['from_time'][$cc]."',";
						$sqAR.="'".$_POST['to_time'][$cc]."',";
						$sqAR.="'".(int)$sT."',";
						$sqAR.="'".$_POST['confirm_status'][$cc]."',";
						$sqAR.="'1',";
						$sqAR.="'".$added_by."',";
						$sqAR.="'".$added_on."')";
						/* echo $sqAR; */
						/* die(); */
						mysql_query($sqAR); 
					
		}

	
	
	
	
	}
}
	/* die(); */

/* End Hall Booking */





/* End Dash Hall insert */




$sqlHg="UPDATE bq_gennextvalue SET ";
$sqlHg=$sqlHg."currvalue='".$bookNo."'";
$sqlHg=$sqlHg." where field='bookno'" ;
$UsQHg =mysql_query($sqlHg);
	
	

	
if($UsQueCy){
		header('location:'.$home_path.'/transaction/frontdesk/hall-booking.php?msg='.$bookNum.' generated successfully!.');
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/hall-booking.php?msg=Error in insertion');
	}	
?>