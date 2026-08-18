<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$book_date=$_POST['book_date'];
$systemn = gethostname();
$localIP = getHostByName(getHostName());

/* Start Dash Hall insert */

$sqlS=mysql_query("select * from bq_gennextvalue where field='bookno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$bookNo=$rowS['currvalue']+1;
$bookNum=$prefix.$bookNo;

$slHn=mysql_query("select prefix,currvalue from bq_gennextvalue where field='performa'");
$rwHn=mysql_fetch_array($slHn);
$prfx=$rwHn['prefix'];
$currvalue=$rwHn['currvalue']+1;
$PINum=$prfx.$currvalue;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];


$sqlcm=mysql_query("select comp_code,comp_name from company_master where comp_code='".$_POST['comp_code']."'");
$rowcm=mysql_fetch_array($sqlcm);


/* Start Hall Booking */
$gstname=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['guest_name']);
$add1=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['address1']);
$add2=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['address2']);
$city=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['city']);
$gstno=$_POST['gst_no'];
$compcde=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['comp_code']);
$compname=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['comp_name']);
$compadd1=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['comaddress1']);
$compadd2=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['comaddress2']);
$compcity=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['comcity']);
$remarks=preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['remarks']);

for( $cc=0; $cc<count($book_date); $cc++ ){
	if($_POST['book_date'][$cc]!=''){
		$adv="";
		$sts="";
		$log_sts="1";
		$sqlAR="insert into  bq_hallbooking(audit_date,book_date,booking_no,venue,session,from_time,to_time,seating,funct,expected,guaranted,	plan_rate,hall_rate,confirm_status,fp_status,chief_guest,corporate,bride,groom,bride_loc,groom_loc,title,guest_name,address1,address2,city,pin, 	state,country,phone,email,gstin,comp_code,company_name,comaddress1,comaddress2,comcity,compin,comstate,comcountry,comphone,comemail,contact_person,contact_mobile,booked_by,booker_id,top_code,business_src,segment_code,purpose_visit,pay_mode,remind_date,remarks,adv,aprove_sts,log_status,systemname,systemip,added_by,added_on)";
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
		$sqlAR.="'".$_POST['plan_rate'][$cc]."',";
		$sqlAR.="'".$_POST['hall_rate'][$cc]."',";
		$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
		$sqlAR.="'".$sts."',";
		$sqlAR.="'".$_POST['chf_guest']."',";
		$sqlAR.="'".$_POST['corporate']."',";
		$sqlAR.="'".$_POST['bride']."',";
		$sqlAR.="'".$_POST['groom']."',";
		$sqlAR.="'".$_POST['bride_loc']."',";
		$sqlAR.="'".$_POST['groom_loc']."',";
		$sqlAR.="'".$_POST['title']."',";
		$sqlAR.="'".mysql_real_escape_string($gstname)."',";
		$sqlAR.="'".mysql_real_escape_string($add1)."',";
		$sqlAR.="'".mysql_real_escape_string($add2)."',";
		$sqlAR.="'".mysql_real_escape_string($city)."',";
		$sqlAR.="'".$_POST['pin_code']."',";
		$sqlAR.="'".$_POST['state']."',";
		$sqlAR.="'".$_POST['country']."',";
		$sqlAR.="'".$_POST['phone']."',";
		$sqlAR.="'".$_POST['email']."',";
		$sqlAR.="'".$gstno."',";
		$sqlAR.="'".mysql_real_escape_string($compcde)."',";
		$sqlAR.="'".mysql_real_escape_string($compname)."',";
		$sqlAR.="'".mysql_real_escape_string($compadd1)."',";
		$sqlAR.="'".mysql_real_escape_string($compadd2)."',";
		$sqlAR.="'".mysql_real_escape_string($compcity)."',";
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
		$sqlAR.="'".mysql_real_escape_string($remarks)."',";
		$sqlAR.="'".$adv."',";
		$sqlAR.="'".$sts."',";
		$sqlAR.="'".$log_sts."',";
		$sqlAR.="'".$systemn."',";
		$sqlAR.="'".$localIP."',";
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
	
$sqlPI="UPDATE bq_gennextvalue SET ";
$sqlPI=$sqlPI."currvalue='".$currvalue."'";
$sqlPI=$sqlPI." where field='performa'" ;
$UsQHg =mysql_query($sqlPI);	


	if($UsQueCy){
		$link = "<script>window.open('$home_path/transaction/view/performa_invoice.php?PIno=$PINum&bkNo=$bookNum', '_blank','width=1000,height=700')</script>";
	echo $link;
	$link1 = "<script>window.open('$home_path/transaction/frontdesk/hall-booking.php?msg=$bookNum generated successfully!', '_self','')</script>";
	echo $link1;
		/*header('location:'.$home_path.'/transaction/frontdesk/hall-booking.php?msg='.$bookNum.' generated successfully!.');*/
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/hall-booking.php?msg=Error in insertion');
	}