<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sql=mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where settleflag!='3' AND bill_no='".$_POST['bl']."'"));
$slR=mysql_fetch_array(mysql_query("select * from bq_opbillhdr where bill_no='".$_POST['bl']."'"));
$slb=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$_POST['bk']."' "));


$blk="";

$sqlAR="insert into bqt_gst_amend(audit_date,bill_no,bill_date,prevcompname,prevguestname,prevaddress1,prevaddress2,prevcity,prevpin,prevgstin,prevphone,amdcompname,amdguestname,amdaddress1,amdaddress2,amdcity,amdpin,amdgstin,amdgstmobile,status,added_by,added_on)";
		$sqlAR.=" values(";
		$sqlAR.="'".$adtCurDt."',";
		$sqlAR.="'".$_POST['bl']."',";
		$sqlAR.="'".$sql['bill_date']."',";
		$sqlAR.="'".$slb['company_name']."',";
		$sqlAR.="'".$slR['fname']."',";
		$sqlAR.="'".$slR['add1']."',";
		$sqlAR.="'".$slR['add2']."',";
		$sqlAR.="'".$slR['city']."',";
		$sqlAR.="'".$slR['pin']."',";
		$sqlAR.="'".$slR['gst_no']."',";
		$sqlAR.="'".$slb['phone']."',";
		$sqlAR.="'".$_POST['company_name']."',";
		$sqlAR.="'".$_POST['guest_name']."',";
		$sqlAR.="'".$_POST['gst_address1']."',";
		$sqlAR.="'".$_POST['gst_address2']."',";
		$sqlAR.="'".$_POST['gst_city']."',";
		$sqlAR.="'".$_POST['gst_pin']."',";
		$sqlAR.="'".$_POST['gstin']."',";
		$sqlAR.="'".$_POST['gst_mobile']."',";
		$sqlAR.="'1',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		/* echo $sqlAR; */
		 $UsQueCy =mysql_query($sqlAR); 
		/* die(); */ 


$sqll="UPDATE bq_opbillhdr SET ";
$sqll=$sqll."fname='".$_POST['guest_name']."',";
$sqll=$sqll."add1='".$_POST['gst_address1']."',";
$sqll=$sqll."add2='".$_POST['gst_address2']."',";
$sqll=$sqll."city='".$_POST['gst_city']."',";
$sqll=$sqll."pin='".$_POST['gst_pin']."',";
$sqll=$sqll."gst_no='".$_POST['gstin']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where bill_no='".$_POST['bl']."'";
$UsQueCy =mysql_query($sqll); 

$sqlb="UPDATE bq_hallbooking SET ";
$sqlb=$sqlb."guest_name='".$_POST['guest_name']."',";
$sqlb=$sqlb."company_name='".$_POST['company_name']."',";
$sqlb=$sqlb."phone='".$_POST['gst_mobile']."',";
$sqlb=$sqlb."address1='".$_POST['gst_address1']."',";
$sqlb=$sqlb."address2='".$_POST['gst_address2']."',";
$sqlb=$sqlb."city='".$_POST['gst_city']."',";
$sqlb=$sqlb."pin='".$_POST['gst_pin']."',";
$sqlb=$sqlb."gstin='".$_POST['gstin']."',";
$sqlb=$sqlb."added_by='".$added_by."',";
$sqlb=$sqlb."added_on='".$added_on."'";
$sqlb=$sqlb." where booking_no='".$_POST['bk']."'";
$UsQueCy =mysql_query($sqlb);

$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];

	if($UsQueCy){
	
	    header('location:'.$home_path.'/transaction/frontdesk/gst_amendment.php?fromdate='.$from_date.'&todate='.$to_date); 
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/gst_amendment.php?msg=Error in insertion');
	}


	
?>