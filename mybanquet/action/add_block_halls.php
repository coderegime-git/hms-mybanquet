<?php

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$book_date=$_POST['book_date'];

if(isset($_POST['add']))
{
/* Start Dash Hall insert */

$sqlS=mysql_query("select * from bq_gennextvalue where field='bookno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$bookNo=$rowS['currvalue']+1;
$bookNum=$prefix.$bookNo;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];


$sqlcm=mysql_query("select comp_code,comp_name from company_master where comp_code='".$_POST['comp_code']."'");
$rowcm=mysql_fetch_array($sqlcm);


/* Start Hall Booking */
// for( $cc=0; $cc<count($book_date); $cc++ ){
	// if($_POST['book_date'][$cc]!=''){
		$adv="";
		$sts="";
		$sqlAR="insert into  bq_hallbooking(audit_date,book_date,booking_no,venue,session,from_time,to_time,confirm_status,fp_status,adv,added_by,added_on)";
		$sqlAR.=" values(";
		$sqlAR.="'".$curDate."',";
		$sqlAR.="'".$_POST['book_date']."',";
		$sqlAR.="'".$bookNum."',";
		$sqlAR.="'".$_POST['venue']."',";
		$sqlAR.="'".$_POST['session']."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['from_time'])."',";
		$sqlAR.="'".mysql_real_escape_string($_POST['to_time'])."',";
		// $sqlAR.="'".$_POST['seating'][$cc]."',";
		// $sqlAR.="'".$_POST['funct'][$cc]."',";
		// $sqlAR.="'".$_POST['expected'][$cc]."',";
		// $sqlAR.="'".$_POST['guaranted'][$cc]."',";
		// $sqlAR.="'".$_POST['hall_rate'][$cc]."',";
		$sqlAR.="'".$_POST['confirm_status']."',";
		$sqlAR.="'".$sts."',";
		// $sqlAR.="'".$_POST['chief_guest'][$cc]."',";
		// $sqlAR.="'".$_POST['corporate']."',";
		// $sqlAR.="'".$_POST['title']."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['guest_name'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['address1'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['address2'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['city'])."',";
		// $sqlAR.="'".$_POST['pin_code']."',";
		// $sqlAR.="'".$_POST['state']."',";
		// $sqlAR.="'".$_POST['country']."',";
		// $sqlAR.="'".$_POST['phone']."',";
		// $sqlAR.="'".$_POST['email']."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['gst_no'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['comp_code'])."',";
		// $sqlAR.="'".mysql_real_escape_string($rowcm['comp_name'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['comaddress1'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['comaddress2'])."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['comcity'])."',";
		// $sqlAR.="'".$_POST['compincode']."',";
		// $sqlAR.="'".$_POST['comstate']."',";
		// $sqlAR.="'".$_POST['comcountry']."',";
		// $sqlAR.="'".$_POST['comphone']."',";
		// $sqlAR.="'".$_POST['comemail']."',";
		// $sqlAR.="'".$_POST['contact_person']."',";
		// $sqlAR.="'".$_POST['contact_mobile']."',";
		// $sqlAR.="'".$_POST['booked_by']."',";
		// $sqlAR.="'".$_POST['booker_id']."',";
		// $sqlAR.="'".$_POST['top_code']."',";
		// $sqlAR.="'".$_POST['business_src']."',";
		// $sqlAR.="'".$_POST['segment_code']."',";
		// $sqlAR.="'Null',";
		// $sqlAR.="'".$_POST['pay_mode']."',";
		// $sqlAR.="'".$_POST['remind_date']."',";
		// $sqlAR.="'".mysql_real_escape_string($_POST['remarks'])."',";
		$sqlAR.="'".$adv."',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		  /* echo $sqlAR; 
		 die(); */
		$UsQueCy =mysql_query($sqlAR); 
		 
		 $reg_id = mysql_insert_id();
		 
		 
	$bokD=$_POST['book_date'];
	$fr=explode('/',$bokD);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	
		$starttime = $_POST['from_time'];  // your start time
		$endtime = $_POST['to_time'];  // End time
		$duration = '60';  // split by 30 mins
		$st=explode(':',$starttime); 
		$str=$st[0];
		$en=explode(':',$endtime); 
		$enr=$en[0];
		
		for($sT=$str;$sT<=$enr;$sT++){
				/* echo $sT; */
				$sqAR="insert into bq_dashhall(audit_date,funtion_date,booking_no,hallbook_id,venue,session,from_time,to_time,hour,confirm_status,status,added_by,added_on)";
						$sqAR.=" values(";
						$sqAR.="'".$curDate."',";
						$sqAR.="'".$_POST['book_date']."',";
						$sqAR.="'".$bookNum."',";
						$sqAR.="'".$reg_id."',";
						// $sqAR.="'".mysql_real_escape_string($_POST['guest_name'])."',";
						$sqAR.="'".mysql_real_escape_string($_POST['venue'])."',";
						$sqAR.="'".$_POST['session']."',";
						$sqAR.="'".$_POST['from_time']."',";
						$sqAR.="'".$_POST['to_time']."',";
						$sqAR.="'".(int)$sT."',";
						$sqAR.="'".$_POST['confirm_status']."',";
						$sqAR.="'1',";
						$sqAR.="'".$added_by."',";
						$sqAR.="'".$added_on."')";
						/* echo $sqAR; */
						/* die(); */
						mysql_query($sqAR); 
					
		}
   // }
// }
	
$sqlHg="UPDATE bq_gennextvalue SET ";
$sqlHg=$sqlHg."currvalue='".$bookNo."'";
$sqlHg=$sqlHg." where field='bookno'" ;
$UsQHg =mysql_query($sqlHg);
	
	

	
if($UsQueCy){
		header('location:'.$home_path.'/transaction/frontdesk/view-block-hall.php?msg='.$bookNum.' generated successfully!.');
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/view-block-hall.php?msg=Error in insertion');
	}	
}


if(isset($_POST['release']))
{
$sqlB=mysql_query("select * from bq_hallbooking where venue='".$_POST['venue']."' AND session='".$_POST['session']."' AND book_date='".$_POST['book_date']."' AND confirm_status='6'");
if(mysql_num_rows($sqlB)>0){
		
		$sql="delete from bq_dashhall";
		$sql=$sql." where venue='".$_POST['venue']."' AND session='".$_POST['session']."' AND funtion_date='".$_POST['book_date']."' AND confirm_status='6'";
		$result=mysql_query($sql);
		
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');
$curdate=$rowAC['cur_date'];
$dtr = explode('-',$_POST['from_date']);
$dy = $dtr[0].'/'.$dtr[1].'/'.$dtr[2];
		
		
		$sqlBl="UPDATE bq_hallbooking SET ";
		$sqlBl=$sqlBl."confirm_status='1',";
		$sqlBl=$sqlBl."added_by='".$added_by."',";
		$sqlBl=$sqlBl."added_on='".$added_on."'";
		$sqlBl=$sqlBl." where venue='".$_POST['venue']."' AND session='".$_POST['session']."' AND book_date='".$_POST['book_date']."'";
		$UsQ=mysql_query($sqlBl);
		
		/* $sqBl="UPDATE dash_rmstats SET ";
		$sqBl=$sqBl."status='2'";
		$sqBl=$sqBl." where room_no='".$_POST['room_no']."' AND resv_no='blk' AND status='1'";
		$UsBl=mysql_query($sqBl); */
		
		if($UsQ){
			header('location:'.$home_path.'/dashboard.php?msg=Hall released Successfully!');
		}
		else{
			header('location:'.$home_path.'/dashboard.php?msg=Error in updation');
		}
		
		
}
}
?>
