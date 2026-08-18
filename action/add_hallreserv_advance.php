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
$cr=explode('/',$curDate);
$crR=$cr[2].'-'.$cr[1].'-'.$cr[0];

$bk=explode('/',$_POST['book_date']);
$bkR=$bk[2].'-'.$bk[1].'-'.$bk[0];

$status='1';

$rq=mysql_fetch_array(mysql_query("select adv_tax from bq_taxdetail"));
$adv_tax=$rq['adv_tax'];

$sql=mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='$adv_tax' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['facT'];
		$fcVl=$factor_value+100;
		$htx=$_POST['amount']/$fcVl*100;
		/* $tx=$_POST['amount']-$htx; */
	/* 	echo sprintf("%01.2f",$htx).','.$hchg; */
	}
	$txAmt=sprintf("%01.2f",$htx);
	$slGnr=mysql_query("SELECT count(*) as cnt FROM `hms_parameters` WHERE description = 'Enable Advance tax' and status='1' and module_name='Banquets'");
$rwGnr=mysql_fetch_array($slGnr);
if($rwGnr['cnt'] == '1'){
	$txAmt=sprintf("%01.2f",$htx);
}else{
	$txAmt=sprintf("%01.2f",$_POST['amount']);
}
$sl=mysql_fetch_array(mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='".$adv_tax."' AND tax_code='CGST 9' AND status='1'"));
$sgst=$txAmt*$sl['facT']/100;

$slc=mysql_fetch_array(mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='".$adv_tax."' AND tax_code='SGST 9' AND status='1'"));
$cgst=$txAmt*$slc['facT']/100;
$slGnr=mysql_query("SELECT count(*) as cnt FROM `hms_parameters` WHERE description = 'Enable Advance tax' and status='1' and module_name='Banquets'");
$rwGnr=mysql_fetch_array($slGnr);
if($rwGnr['cnt'] == '1'){
	$sgst=$sgst;
	$cgst=$cgst;
}else{
	$sgst="0.00";
	$cgst="0.00";
}
$TottxAMt=$sgst+$cgst;
$netAmt=sprintf("%01.2f",$txAmt+$TottxAMt);

if($cr[1]!=$bk[1]){
$CDte=$curDate;	
}else{
$CDte="";	
}
	
$sql="insert into bq_hallresvadv(cur_date,adjust,booking_no,hallbook_id,function_date,receipt_no,guest_name,amount,inclamt,taxamt ,sgst,cgst,netamt,adjusted,balance,pay_mode,card_desc,upi,cc_cheqno,cheque_date,remarks,tagged_by,tagged_on,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$curDate."',";
	$sql.="'".$CDte."',";
	$sql.="'".$_POST['booking_no']."',";
	$sql.="'".$_POST['hallbook_id']."',";
	$sql.="'".$_POST['book_date']."',";
	$sql.="'".$rcptNum."',";
	$sql.="'".mysql_real_escape_string($_POST['guest_name'])."',";
	$sql.="'".$txAmt."',";
	$sql.="'incl',";
	$sql.="'0.00',";
	$sql.="'".sprintf("%01.2f",$sgst)."',";
	$sql.="'".sprintf("%01.2f",$cgst)."',";
	$sql.="'".$_POST['amount']."',";
	$sql.="'Null',";
	$sql.="'Null',";
	$sql.="'".$_POST['pay_mode']."',";
	$sql.="'".$_POST['card_desc']."',";
	$sql.="'".$_POST['upi']."',";
	$sql.="'".$_POST['cc_cheqno']."',";
	$sql.="'".$_POST['cheque_date']."',";
	$sql.="'".mysql_real_escape_string($_POST['remarks'])."',";
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

$sqB=mysql_query( "select *,SUM(adv)as ad from bq_hallbooking where booking_no='".$_POST['booking_no']."' and hallbook_id='".$_POST['hallbook_id']."'");
$rwB=mysql_fetch_array($sqB);
$advV=$rwB['ad'];
$adva=floatval($advV)+floatval($_POST['amount']);

$sqlr="UPDATE bq_hallbooking SET ";
$sqlr=$sqlr."adv='".$adva."'";
$sqlr=$sqlr." where booking_no='".$_POST['booking_no']."' and venue='".$rwB['venue']."' and session='".$rwB['session']."'";
/*echo $sqlr;
die();*/
$Usk =mysql_query($sqlr);

$rserNo=$_POST['booking_no'];
$rcptNo=$rcptNum;

if($UsQuery){
	// $link = "<script>window.open('$home_path/transaction/view/print-HallReserv-advance.php?rserNo=$rserNo&rcptNo=$rcptNo', '_blank','width=1000,height=700')</script>";
	// echo $link;
	$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-hall-advance.php?rserNo=$rserNo&rcptNo=$rcptNo&msg=Data saved Successfully!', '_self','')</script>";
	echo $link1;
	/* header('location:'.$home_path.'/transaction/frontdesk/view-reservadvance.php?msg=Data saved Successfully!'); */
}
else{
	header('location:'.$home_path.'/transaction/frontdesk/view-hall-advance.php?msg=Error in insertion');
}


?>