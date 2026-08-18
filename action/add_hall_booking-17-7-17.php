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

for($cc=0;$cc<count($_POST['from_time']);$cc++){
	
	$bokD=$_POST['book_date'][$cc];
	$fr=explode('/',$bokD);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
$sqM=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y') = '$frm' AND venue='".$_POST['venue'][$cc]."'");
if(mysql_num_rows($sqM)==0){
			
	if($_POST['from_time'][$cc]!=''){
		
		$starttime = $_POST['from_time'][$cc];  // your start time
		$endtime = $_POST['to_time'][$cc];  // End time
		$duration = '60';  // split by 30 mins
		$st=explode(':',$starttime); 
		$str=$st[0];
		$en=explode(':',$endtime); 
		$enr=$en[0];
		
		for($sT=$str;$sT<=$enr;$sT++){
				if($sT=='06'){$tmS6=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='07'){$tmS7=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='08'){$tmS8=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='09'){$tmS9=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='10'){$tmS10=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='11'){$tmS11=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='12'){$tmS12=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='13'){$tmS13=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='14'){$tmS14=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='15'){$tmS15=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='16'){$tmS16=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='17'){$tmS17=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='18'){$tmS18=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='19'){$tmS19=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='20'){$tmS20=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='21'){$tmS21=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='22'){$tmS22=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='23'){$tmS23=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='24'){$tmS24=$_POST['confirm_status'][$cc].','.$bookNum;}
			if($sT==$str){
				$sqlAR="insert into  bq_dashhallbook(audit_date,book_date,venue,session,from_time,to_time,tme6,tme7,tme8,tme9,tme10,tme11,tme12,tme13,tme14,tme15,tme16,tme17,tme18,tme19,tme20,tme21,tme22,tme23,tme24,status,added_by,added_on)";
						$sqlAR.=" values(";
						$sqlAR.="'".$curDate."',";
						$sqlAR.="'".$_POST['book_date'][$cc]."',";
						/* $sqlAR.="'".$bookNum."',"; */
						$sqlAR.="'".$_POST['venue'][$cc]."',";
						$sqlAR.="'".$_POST['session'][$cc]."',";
						$sqlAR.="'".$_POST['from_time'][$cc]."',";
						$sqlAR.="'".$_POST['to_time'][$cc]."',";
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
						$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
						$sqlAR.="'".$added_by."',";
						$sqlAR.="'".$added_on."')";
						/* echo $sqlAR;
						die(); */
						$UsQueCy =mysql_query($sqlAR); 
						
						$reg_id = mysql_insert_id();
			}
		
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
		/* echo $sqll; */
		
		$sqll=$sqll." where dash_id='".$reg_id."'";

		$resultt=mysql_query($sqll);

			
		}
	}
	}else{
		if($_POST['from_time'][$cc]!=''){
		
				$starttime = $_POST['from_time'][$cc]; 
				$endtime = $_POST['to_time'][$cc]; 
				$st=explode(':',$starttime); 
				$str=$st[0];
				$en=explode(':',$endtime); 
				$enr=$en[0];
			
	
	
	
				for($sT=$str;$sT<=$enr;$sT++){
$sqM=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y') = '$frm' AND venue='".$_POST['venue'][$cc]."'");
$rwM=mysql_fetch_array($sqM);
$dash_id=$rwM['dash_id'];

						if($sT=='06'){$tmS6=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS6=$rwM['tme6'];}
						if($sT=='07'){$tmS7=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS7=$rwM['tme7'];}
						if($sT=='08'){$tmS8=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS8=$rwM['tme8'];}
						if($sT=='09'){$tmS9=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS9=$rwM['tme9'];}
						if($sT=='10'){$tmS10=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS10=$rwM['tme10'];}
						if($sT=='11'){$tmS11=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS11=$rwM['tme11'];}
						if($sT=='12'){$tmS12=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS12=$rwM['tme12'];}
						if($sT=='13'){$tmS13=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS13=$rwM['tme13'];}
						if($sT=='14'){$tmS14=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS14=$rwM['tme14'];}
						if($sT=='15'){$tmS15=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS15=$rwM['tme15'];}
						if($sT=='16'){$tmS16=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS16=$rwM['tme16'];}
						if($sT=='17'){$tmS17=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS17=$rwM['tme17'];}
						if($sT=='18'){$tmS18=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS18=$rwM['tme18'];}
						if($sT=='19'){$tmS19=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS19=$rwM['tme19'];}
						if($sT=='20'){$tmS20=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS20=$rwM['tme20'];}
						if($sT=='21'){$tmS21=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS21=$rwM['tme21'];}
						if($sT=='22'){$tmS22=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS22=$rwM['tme22'];}
						if($sT=='23'){$tmS23=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS23=$rwM['tme23'];}
						if($sT=='24'){$tmS24=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS24=$rwM['tme24'];}
					

	
	
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
						$sqll=$sqll." where dash_id='".$dash_id."'";
						/* echo $sqll; */
						
						$resultt=mysql_query($sqll);
				}
				
			
	}
	}
}
/* 
die(); */

/* End Dash Hall insert */










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
		$sqlAR.="'".$_POST['from_time'][$cc]."',";
		$sqlAR.="'".$_POST['to_time'][$cc]."',";
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
		$sqlAR.="'".$_POST['guest_name']."',";
		$sqlAR.="'".$_POST['address1']."',";
		$sqlAR.="'".$_POST['address2']."',";
		$sqlAR.="'".$_POST['city']."',";
		$sqlAR.="'".$_POST['pin_code']."',";
		$sqlAR.="'".$_POST['state']."',";
		$sqlAR.="'".$_POST['country']."',";
		$sqlAR.="'".$_POST['phone']."',";
		$sqlAR.="'".$_POST['email']."',";
		$sqlAR.="'".$_POST['comp_code']."',";
		$sqlAR.="'".$_POST['company_name']."',";
		$sqlAR.="'".$_POST['comaddress1']."',";
		$sqlAR.="'".$_POST['comaddress2']."',";
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
		$sqlAR.="'".$_POST['remarks']."',";
		$sqlAR.="'".$adv."',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		/* echo $sqlAR; */ 
	
		 $UsQueCy =mysql_query($sqlAR); 
	}
}
	/* die(); */

/* End Hall Booking */


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