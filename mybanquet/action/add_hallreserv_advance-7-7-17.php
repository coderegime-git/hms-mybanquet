<?php

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlS=mysql_query("select * from bq_gennextvalue where field='bkrcptno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$rcptNo=$rowS['currvalue']+1;
$rcptNum=$prefix.$rcptNo;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$status='1';

$sql="insert into bq_hallresvadv(cur_date,booking_no,hallbook_id,function_date,receipt_no,guest_name,amount,adjusted,balance,pay_mode,card_desc,cc_cheqno,cheque_date,remarks, 	tagged_by,tagged_on,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['booking_no']."',";
	$sql.="'".$_POST['hallbook_id']."',";
	$sql.="'".$_POST['book_date']."',";
	$sql.="'".$rcptNum."',";
	$sql.="'".$_POST['guest_name']."',";
	$sql.="'".$_POST['amount']."',";
	$sql.="'Null',";
	$sql.="'Null',";
	$sql.="'".$_POST['pay_mode']."',";
	$sql.="'".$_POST['card_desc']."',";
	$sql.="'".$_POST['cc_cheqno']."',";
	$sql.="'".$_POST['cheque_date']."',";
	$sql.="'".$_POST['remarks']."',";
	$sql.="'Null',";
	$sql.="'Null',";
	$sql.="'".$status."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/* echo $sql;
die(); */
$UsQuery =mysql_query($sql); 


if($_POST['pay_mode']=='cash'){
	$resvADV='rsadvcash';
}else if($_POST['pay_mode']=='card'){
	$resvADV='rsadvcard';
}else if($_POST['pay_mode']=='NEFT'){
	$resvADV='RSADVNEFT';
}else if($_POST['pay_mode']=='cheque'){
	$resvADV='rsadvchq';
}

$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$rcptNo."'";
$sqlLk=$sqlLk." where field='bkrcptno'";
$UsQLk =mysql_query($sqlLk);

$sqB=mysql_query("select SUM(adv)as ad from bq_hallbooking where booking_no='".$_POST['booking_no']."'");
$rwB=mysql_fetch_array($sqB);
$advV=$rwB['ad'];
$adva=floatval($advV)+floatval($_POST['amount']);

$sqlr="UPDATE bq_hallbooking SET ";
$sqlr=$sqlr."adv='".$adva."'";
$sqlr=$sqlr." where booking_no='".$_POST['booking_no']."'";
$Usk =mysql_query($sqlr);

$rserNo=$_POST['booking_no'];
$rcptNo=$rcptNum;

if($UsQuery){
	$link = "<script>window.open('$home_path/transaction/view/print-HallReserv-advance.php?rserNo=$rserNo&rcptNo=$rcptNo', '_blank','width=1000,height=700')</script>";
	echo $link;
	$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-hall-advance.php?msg=Data saved Successfully!', '_self','')</script>";
	echo $link1;
	/* header('location:'.$home_path.'/transaction/frontdesk/view-reservadvance.php?msg=Data saved Successfully!'); */
}
else{
	header('location:'.$home_path.'/transaction/frontdesk/view-hall-advance.php?msg=Error in insertion');
}


?>