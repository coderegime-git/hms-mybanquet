<?php
session_start();
include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cur_date=$rowAC['cur_date'];

$sqlGT=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['book_no']."' AND confirm_status!='1'");
$rowGT=mysql_fetch_array($sqlGT);

$slHn=mysql_query("select prefix,currvalue from bq_gennextvalue where field='advrefund'");
$rwHn=mysql_fetch_array($slHn);
$prefix=$rwHn['prefix'];
$currvalue=$rwHn['currvalue']+1;
$rcpt=$prefix.$currvalue;

$sqR=mysql_fetch_array(mysql_query("select receipt_no from bq_hallresvadv where receipt_no='".$_POST['receipt_no']."'"));

$sql="insert into bqt_reservrefund(cur_date,booking_no,book_date,adv_rcpt,receipt_no,hallbook_id,guest_name,venue,amount,	ref_amt,ret_amt,adjusted,balance,pay_mode,card_desc,cc_cheqno,cheque_date,remarks,tagged_by,tagged_on,chk_status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['cur_date']."',";
	$sql.="'".$_POST['book_no']."',";
	$sql.="'".$rowGT['book_date']."',";
	$sql.="'".$_POST['receipt_no']."',";
	$sql.="'".$rcpt."',";
	$sql.="'".$_POST['book_no']."',";
	$sql.="'".$_POST['guest_name']."',";
	$sql.="'".$rowGT['venue']."',";
	$sql.="'".$_POST['amount']."',";
	$sql.="'".$_POST['ref_amt']."',";
	$sql.="'".$_POST['ret_amt']."',";
	$sql.="'Null',";
	$sql.="'Null',";
	$sql.="'".$_POST['pay_mode']."',";
	$sql.="'".$_POST['card_desc']."',";
	$sql.="'".$_POST['cc_cheqno']."',";
	$sql.="'".$_POST['cheque_date']."',";
	$sql.="'".$_POST['remarks']."',";
	$sql.="'Null',";
	$sql.="'Null',";
	$sql.="'1',";
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
$sqlLk=$sqlLk."currvalue='".$currvalue."'";
$sqlLk=$sqlLk." where field='advrefund'" ;
$UsQLk =mysql_query($sqlLk);

$sqlr="UPDATE bq_hallresvadv SET ";
$sqlr=$sqlr."status='4'";
$sqlr=$sqlr." where receipt_no='".$_POST['receipt_no']."'";
$UsQLk =mysql_query($sqlr); 

$sqB=mysql_query("select SUM(amount)as ad from bq_hallresvadv where booking_no='".$_POST['book_no']."' and status='1'");
$rwB=mysql_fetch_array($sqB);
$advV=$rwB['ad'];

$sqlr="UPDATE bq_hallbooking SET ";
$sqlr=$sqlr."adv='".$advV."'";
$sqlr=$sqlr." where booking_no='".$_POST['book_no']."'";
$Usk =mysql_query($sqlr);
		
$sqlLD=mysql_query("select ledger_id from ledgers where ledger_code='$resvADV'");
$rowLD=mysql_fetch_array($sqlLD);

$todayDate=date('d/m/Y');
 $split="";
 
$bkNo=$_POST['book_no'];
$rcptNo=$rcpt;

	
if($UsQuery){
	$link = "<script>window.open('$home_path/transaction/view/print-reserv-refund.php?bkNo=$bkNo&rcptNo=$rcptNo', '_blank','width=1000,height=700')</script>";
	echo $link;
	$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-reservadvance.php?msg=Data saved Successfully!', '_self','')</script>";
	echo $link1;
}else{
	header('location:'.$home_path.'/transaction/frontdesk/view-resadvrefund.php?msg=Error in insertion');
}


?>