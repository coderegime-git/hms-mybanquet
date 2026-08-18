<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$book_date=$_POST['book_date'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];


/*  Start Hall Booking Cancelled */
for($cc=0; $cc<count($_POST['book_date']);$cc++ ) {
if($_POST['confirm_status'][$cc]==7) {
		
$bokD=$_POST['book_date'][$cc];
$fr=explode('/',$bokD);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];

$sqll="UPDATE bq_hallbooking SET ";
$sqll=$sqll."audit_date='".$curDate."',";
$sqll=$sqll."confirm_status='".$_POST['confirm_status'][$cc]."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
mysql_query($sqll);


$sqll="UPDATE bq_dashhall SET ";
$sqll=$sqll."audit_date='".$curDate."',";
$sqll=$sqll."confirm_status='".$_POST['confirm_status'][$cc]."',";
$sqll=$sqll."status='2',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
mysql_query($sqll);


}
}
/*  End  Hall Booking Cancelled */




/*  Start Hall Booking Updated with already exists */
for($cc=0; $cc<count($_POST['book_date']);$cc++ ) {
if($_POST['confirm_status'][$cc]!=7 && $_POST['confirm_status'][$cc]!='') {
	
$bokD=$_POST['book_date'][$cc];
$fr=explode('/',$bokD);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];

/* $sbD=mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y')='$frm' AND venue='".$_POST['venue'][$cc]."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'");
while($rRe=mysql_fetch_array($sbD)){ */
	
	$sql="delete from bq_dashhall";
	$sql=$sql." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
	$result=mysql_query($sql);
		
		$starttime = $_POST['from_time'][$cc];  // your start time
		$endtime = $_POST['to_time'][$cc];  // End time
		$duration = '60';  // split by 30 mins
		$st=explode(':',$starttime); 
		$str=$st[0];
		$en=explode(':',$endtime); 
		$enr=$en[0];
		
		for($sT=$str;$sT<=$enr;$sT++){
				$sqlAR="insert into bq_dashhall(audit_date,funtion_date,booking_no,hallbook_id,guest_name,venue,session,from_time,to_time,hour,confirm_status,status,added_by,added_on)";
						$sqlAR.=" values(";
						$sqlAR.="'".$curDate."',";
						$sqlAR.="'".$_POST['book_date'][$cc]."',";
						$sqlAR.="'".$_POST['bookNum']."',";
						$sqlAR.="'".$_POST['hallbook_id'][$cc]."',";
						$sqlAR.="'".mysql_real_escape_string($_POST['guest_name'])."',";
						$sqlAR.="'".mysql_real_escape_string($_POST['venue'][$cc])."',";
						$sqlAR.="'".$_POST['session'][$cc]."',";
						$sqlAR.="'".$_POST['from_time'][$cc]."',";
						$sqlAR.="'".$_POST['to_time'][$cc]."',";
						$sqlAR.="'".(int)$sT."',";
						$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
						$sqlAR.="'1',";
						$sqlAR.="'".$added_by."',";
						$sqlAR.="'".$added_on."')";
					 /* echo $sqlAR; */ 
						/* die(); */
						$UsQueCy =mysql_query($sqlAR); 
					
		}

/* } */
}
}
/* die(); */


/*  Start Hall Booking */
for($cc=0; $cc<count($book_date);$cc++ ){
	$adv="";
	$sts="";

$sbk=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'");
	if(mysql_num_rows($sbk)>0){
	while($rbK=mysql_fetch_array($sbk)){
		 if($_POST['book_date'][$cc]!=''){ 
			$sqll="UPDATE bq_hallbooking SET ";
			$sqll=$sqll."audit_date='".$curDate."',";
			$sqll=$sqll."book_date='".$_POST['book_date'][$cc]."',";
			$sqll=$sqll."booking_no='".$_POST['bookNum']."',";
			$sqll=$sqll."venue='".$_POST['venue'][$cc]."',";
			$sqll=$sqll."session='".$_POST['session'][$cc]."',";
			$sqll=$sqll."from_time='".mysql_real_escape_string($_POST['from_time'][$cc])."',";
			$sqll=$sqll."to_time='".mysql_real_escape_string($_POST['to_time'][$cc])."',";
			$sqll=$sqll."seating='".$_POST['seating'][$cc]."',";
			$sqll=$sqll."funct='".$_POST['funct'][$cc]."',";
			$sqll=$sqll."expected='".$_POST['expected'][$cc]."',";
			$sqll=$sqll."guaranted='".$_POST['guaranted'][$cc]."',";
			$sqll=$sqll."hall_rate='".$_POST['hall_rate'][$cc]."',";
			$sqll=$sqll."confirm_status='".$_POST['confirm_status'][$cc]."',";
			$sqll=$sqll."fp_status='".$sts."',";
			$sqll=$sqll."chief_guest='".$_POST['chief_guest'][$cc]."',";
			$sqll=$sqll."corporate='".$_POST['corporate']."',";
			$sqll=$sqll."title='".$_POST['title']."',";
			$sqll=$sqll."guest_name='".mysql_real_escape_string($_POST['guest_name'])."',";
			$sqll=$sqll."address1='".mysql_real_escape_string($_POST['address1'])."',";
			$sqll=$sqll."address2='".mysql_real_escape_string($_POST['address2'])."',";
			$sqll=$sqll."city='".$_POST['city']."',";
			$sqll=$sqll."pin='".$_POST['pin_code']."',";
			$sqll=$sqll."state='".$_POST['state']."',";
			$sqll=$sqll."country='".$_POST['country']."',";
			$sqll=$sqll."phone='".$_POST['phone']."',";
			$sqll=$sqll."email='".$_POST['email']."',";
			$sqll=$sqll."comp_code='".$_POST['comp_code']."',";
			$sqll=$sqll."company_name='".mysql_real_escape_string($_POST['company_name'])."',";
			$sqll=$sqll."comaddress1='".mysql_real_escape_string($_POST['comaddress1'])."',";
			$sqll=$sqll."comaddress2='".mysql_real_escape_string($_POST['comaddress2'])."',";
			$sqll=$sqll."comcity='".mysql_real_escape_string($_POST['comcity'])."',";
			$sqll=$sqll."compin='".$_POST['compincode']."',";
			$sqll=$sqll."comstate='".$_POST['comstate']."',";
			$sqll=$sqll."comcountry='".$_POST['comcountry']."',";
			$sqll=$sqll."comphone='".$_POST['comphone']."',";
			$sqll=$sqll."comemail='".$_POST['comemail']."',";
			$sqll=$sqll."contact_person='".$_POST['contact_person']."',";
			$sqll=$sqll."contact_mobile='".$_POST['contact_mobile']."',";
			$sqll=$sqll."booked_by='".$_POST['booked_by']."',";
			$sqll=$sqll."booker_id='".$_POST['booker_id']."',";
			$sqll=$sqll."top_code='".$_POST['top_code']."',";
			$sqll=$sqll."business_src='".$_POST['business_src']."',";
			$sqll=$sqll."segment_code='".$_POST['segment_code']."',";
			$sqll=$sqll."purpose_visit='Null',";
			$sqll=$sqll."pay_mode='".$_POST['pay_mode']."',";
			$sqll=$sqll."remind_date='".$_POST['remind_date']."',";
			$sqll=$sqll."remarks='".mysql_real_escape_string($_POST['remarks'])."',";
			$sqll=$sqll."added_by='".$added_by."',";
			$sqll=$sqll."added_on='".$added_on."'";
			$sqll=$sqll." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
			  /* echo $sqll;  */
		 
			$UsQueCy=mysql_query($sqll);
			
$rlB=mysql_fetch_array(mysql_fetch_array("select hallchrg from bq_opfpmenuhdr where bkno='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'"));
if($rlB['hallchrg']>0){
	
}else{
	$sqll="UPDATE bq_opfpmenuhdr SET ";
	$sqll=$sqll."ratechrg='".$_POST['hall_rate'][$cc]."'";
	$sqll=$sqll." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
	$UsQueCy=mysql_query($sqll);
}
		
		  }
	  }
	  	/* die(); */ 
	}
	
	 else{
		 if($_POST['book_date'][$cc]!=''){ 
			$adv="";
			$sts="";
			$sqlAR="insert into  bq_hallbooking(audit_date,book_date,booking_no,venue,session,from_time,to_time,seating,funct,expected,guaranted,hall_rate,confirm_status,fp_status,chief_guest,corporate,title,guest_name,address1,address2,city,pin, 	state,country,phone,email,comp_code,company_name,comaddress1,comaddress2,comcity,compin,comstate,comcountry,comphone,comemail,contact_person,contact_mobile,booked_by,booker_id,top_code,business_src,segment_code,purpose_visit,pay_mode,remind_date,remarks,adv,added_by,added_on)";
			$sqlAR.=" values(";
			$sqlAR.="'".$curDate."',";
			$sqlAR.="'".$_POST['book_date'][$cc]."',";
			$sqlAR.="'".$_POST['bookNum']."',";
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
			$sqlAR.="'".$_POST['city']."',";
			$sqlAR.="'".$_POST['pin_code']."',";
			$sqlAR.="'".$_POST['state']."',";
			$sqlAR.="'".$_POST['country']."',";
			$sqlAR.="'".$_POST['phone']."',";
			$sqlAR.="'".$_POST['email']."',";
			$sqlAR.="'".mysql_real_escape_string($_POST['comp_code'])."',";
			$sqlAR.="'".mysql_real_escape_string($_POST['company_name'])."',";
			$sqlAR.="'".mysql_real_escape_string($_POST['comaddress1'])."',";
			$sqlAR.="'".mysql_real_escape_string($_POST['comaddress2'])."',";
			$sqlAR.="'".$_POST['comcity']."',";
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
		 } 
	} 
}
/* End Hall Booking */








if($UsQueCy){
	header('location:'.$home_path.'/transaction/frontdesk/view-hall-booking.php?msg='.$bookNum.' generated successfully!.');
}
else{
	header('location:'.$home_path.'/transaction/frontdesk/view-hall-booking.php?msg=Error in insertion');
}	
?>