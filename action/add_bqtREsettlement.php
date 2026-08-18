<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

if(isset($_POST['comp_desc'])){
	$compdesc=$_POST['comp_desc'];
}else if(isset($_POST['comp_name'])){
	$compdesc=$_POST['comp_name'];
}else{
	$compdesc="";
}

if(isset($_POST['card_desc'])){
	$card_desc=$_POST['card_desc'];
}else{
	$card_desc="";
}

if(isset($_POST['room_desc'])){
	$room_desc=$_POST['room_desc'];
}else{
	$room_desc="";
}

$sqlCo=mysql_query("select comp_code,comp_name from company_master where comp_code='".$compdesc."'");
$rowCo=mysql_fetch_array($sqlCo);
$comCode=$rowCo['comp_code'];
$comName=$rowCo['comp_name'];

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['bk_no']."'");
$rowb=mysql_fetch_array($sqlb);

$sqm=mysql_query("select vouchrno from bq_opbillhdtl where bill_no='".$_POST['blno']."'");
$rmw=mysql_fetch_array($sqm);

$sqV=mysql_query("select bkno from bq_opvchrhdr where vouchrno='".$rmw['vouchrno']."'");
$rmV=mysql_fetch_array($sqV);



$sG=mysql_query("select * from guest_register where room_no='".$_POST['room_desc']."' AND bill_status='1'");
$rt=mysql_fetch_array($sG);
$guestreg_id=$rt['guestreg_id'];
$guest_name=$rt['guest_name'];


$bankname='';
$flg='1';

$sqlRm="UPDATE bq_opbillstldtl SET ";
	$sqlRm=$sqlRm."bill_no='".$_POST['blno']."',";
	$sqlRm=$sqlRm."bill_date='".$_POST['bill_date']."',";
	$sqlRm=$sqlRm."fpno='".$_POST['fp_no']."',";
	$sqlRm=$sqlRm."bkno='".$_POST['bk_no']."',";
	$sqlRm=$sqlRm."billamt='".$_POST['bill_amt']."',";
	$sqlRm=$sqlRm."cash='".$_POST['cashrcd_amt']."',";
	$sqlRm=$sqlRm."card='".$_POST['cardrcd_amt']."',";
	$sqlRm=$sqlRm."company='".$_POST['comprcd_amt']."',";
	$sqlRm=$sqlRm."cheque='".$_POST['chequercd_amt']."',";
	$sqlRm=$sqlRm."neft='".$_POST['neftrcd_amt']."',";
	$sqlRm=$sqlRm."room='".$_POST['roomrcd_amt']."',";
	$sqlRm=$sqlRm."refund='".$_POST['refundrcd_amt']."',";
	$sqlRm=$sqlRm."void='".$_POST['voidrcd_amt']."',";
	$sqlRm=$sqlRm."roomno='".$_POST['room_desc']."',";
	$sqlRm=$sqlRm."reg_num='".$guestreg_id."',";
	$sqlRm=$sqlRm."guest_name='".$guest_name."',";
	$sqlRm=$sqlRm."card_desc='".$_POST['card_desc']."',";
	$sqlRm=$sqlRm."ccno='".$_POST['card_rem']."',";
	$sqlRm=$sqlRm."compcode='".$comCode."',";
	$sqlRm=$sqlRm."compname='".$comName."',";
	$sqlRm=$sqlRm."chqno='".$_POST['cheq_rem']."',";
	$sqlRm=$sqlRm."chqdate='".$_POST['cheq_desc']."',";
	$sqlRm=$sqlRm."bankname='".$_POST['neft_desc']."',";
	$sqlRm=$sqlRm."neftdetails='".$_POST['neft_rem']."',";
	$sqlRm=$sqlRm."tips='".$_POST['hid_tips']."',";
	$sqlRm=$sqlRm."remarks='".$_POST['hid_menu']."',";
	$sqlRm=$sqlRm."settleflag='".$flg."'";
	$sqlRm=$sqlRm." where bill_no='".$_POST['blno']."'" ;
	/* echo $sqlRm;
	die(); */
	$UsQ=mysql_query($sqlRm);

	
if($_POST['voidrcd_amt']>0){
	$sqlLk="UPDATE bq_opbillhdr SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."'" ;
	$UsQLk =mysql_query($sqlLk); 
	
	$sqlLk="UPDATE bq_opbillhdtl SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."'" ;
	$UsQLk =mysql_query($sqlLk);
}




$sAR=mysql_query("select * from  ar_bills where bill_no='".$_POST['blno']."'");
if(mysql_num_rows($sAR)>0){
if($_POST['comp_desc']!=''){
	$sqlCy="UPDATE  ar_bills SET ";
	$sqlCy=$sqlCy."comp_code='".$comCode."',";
	$sqlCy=$sqlCy."comp_name='".$comName."',";
	$sqlCy=$sqlCy."bill_amount='".$_POST['comprcd_amt']."'";
	$sqlRm=$sqlRm." where bill_no='".$_POST['blno']."'" ;
	$UsQ=mysql_query($sqlRm);
}	
}else{

if(isset($_POST['comp_desc']) && $_POST['comp_desc']!=''){
	$sts="";
	$sqlCy="insert into ar_bills(	bill_date,bill_no,room_no,reg_num,guest_name,module,comp_code,comp_name,bill_amount,arreceipt_no,cash,card,cheque,neft,commission,disc,balance,adjusted_on,adjusted_by,remarks,status,added_by,added_on)";
		$sqlCy.=" values(";
		$sqlCy.="'".$adtCurDt."',";
		$sqlCy.="'".$_POST['blno']."',";
		$sqlCy.="'".$_POST['room_desc']."',";
		$sqlCy.="'".$sts."',";
		$sqlCy.="'".$_POST['guest_name']."',";
		$sqlCy.="'bqt',";
		$sqlCy.="'".$comCode."',";
		$sqlCy.="'".$comName."',";
		$sqlCy.="'".$_POST['bill_amt']."',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'".$_POST['comprcd_amt']."',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'1',";
		$sqlCy.="'".$added_by."',";
		$sqlCy.="'".$added_on."')";
		/* echo $sqlCy;
		die(); */
		$UsQueCy =mysql_query($sqlCy);
}

}




/* START Room Re-Settlement */
$sqGt=mysql_query("select * from  guest_trans where receipt_no='".$_POST['blno']."'");
if(mysql_num_rows($sqGt)==0){
$rowGt=mysql_fetch_array($sqGt);

$sqlGt="UPDATE  guest_trans SET ";
$sqlGt=$sqlGt."bill_status='3'";
$sqlGt=$sqlGt." where receipt_no='".$_POST['blno']."'" ;
mysql_query($sqlGt);


if($_POST['roomrcd_amt']>0){
	
$sqlGt="UPDATE guest_trans SET ";
$sqlGt=$sqlGt."bill_status='3'";
$sqlGt=$sqlGt." where receipt_no='".$_POST['blno']."'" ;
mysql_query($sqlGt);	

$sqlLD=mysql_query("select * from  ledgers where ledger_code='dr' AND status='1'");
$rowLD=mysql_fetch_array($sqlLD);

$sqt=mysql_query("select * from  guest_register where room_no='".$_POST['room_desc']."' AND bill_status='1'");
$rowt=mysql_fetch_array($sqt);

$split="";

 $sqlT="insert into  guest_trans(reg_num,gstreg_id,gst_name,room_no,ref_no,slno,receipt_no,reserv_no,roombook_id,	guest_type,rev_desc,tax_val,debit,credit,trans_date,bill_status,bill_number,pay_mode,pay_details,remarks,split,tempbillno,added_by,added_on)";
	$sqlT.=" values(";
	$sqlT.="'".$rowt['guestreg_id']."',";
	$sqlT.="'".$rowt['guestreg_id']."',";
	$sqlT.="'".$rowt['guest_name']."',";
	$sqlT.="'".$rowt['room_no']."',";
	$sqlT.="'".$rowLD['ledger_id']."',";
	$sqlT.="'".$split."',";
	$sqlT.="'".$_POST['blno']."',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'".$rowLD['description']."',";
	$sqlT.="'Null',";
	$sqlT.="'".$_POST['roomrcd_amt']."',";
	$sqlT.="'Null',";
	$sqlT.="'".$adtCurDt."',";
	$sqlT.="'1',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'".$_POST['room_desc']."',";
	$sqlT.="'".$split."',";
	$sqlT.="'settle',";
	$sqlT.="'".$added_by."',";
	$sqlT.="'".$added_on."')";
 /* echo $sqlT;
 die(); */ 
	$UsQTrans =mysql_query($sqlT);
		
	}
}



$sqGt=mysql_query("select * from guest_trans where receipt_no='".$_POST['blno']."'");
if(mysql_num_rows($sqGt)>0){
$rowGt=mysql_fetch_array($sqGt);

$sqlGt="UPDATE guest_trans SET ";
$sqlGt=$sqlGt."bill_status='3'";
$sqlGt=$sqlGt." where receipt_no='".$_POST['blno']."'" ;
mysql_query($sqlGt);


if($_POST['roomrcd_amt']>0){
	
$sqlGt="UPDATE guest_trans SET ";
$sqlGt=$sqlGt."bill_status='3'";
$sqlGt=$sqlGt." where receipt_no='".$_POST['blno']."'" ;
mysql_query($sqlGt);	

$sqlLD=mysql_query("select * from  ledgers where ledger_code='dr' AND status='1'");
$rowLD=mysql_fetch_array($sqlLD);

$sqt=mysql_query("select * from  guest_register where room_no='".$_POST['room_desc']."' AND bill_status='1'");
$rowt=mysql_fetch_array($sqt);

$split="";

 $sqlT="insert into guest_trans(reg_num,gstreg_id,gst_name,room_no,ref_no,slno,receipt_no,reserv_no,roombook_id,	guest_type,rev_desc,tax_val,debit,credit,trans_date,bill_status,bill_number,pay_mode,pay_details,remarks,split,tempbillno,added_by,added_on)";
	$sqlT.=" values(";
	$sqlT.="'".$rowt['guestreg_id']."',";
	$sqlT.="'".$rowt['guestreg_id']."',";
	$sqlT.="'".$rowt['guest_name']."',";
	$sqlT.="'".$rowt['room_no']."',";
	$sqlT.="'".$rowLD['ledger_id']."',";
	$sqlT.="'".$split."',";
	$sqlT.="'".$_POST['blno']."',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'".$rowLD['description']."',";
	$sqlT.="'Null',";
	$sqlT.="'".$_POST['roomrcd_amt']."',";
	$sqlT.="'Null',";
	$sqlT.="'".$adtCurDt."',";
	$sqlT.="'1',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'Null',";
	$sqlT.="'".$_POST['room_desc']."',";
	$sqlT.="'".$split."',";
	$sqlT.="'settle',";
	$sqlT.="'".$added_by."',";
	$sqlT.="'".$added_on."')";
 /* echo $sqlT;
 die(); */ 
	$UsQTrans =mysql_query($sqlT);
		
	}
}
/* End Room Re-Settlement cashrcd_amt cardrcd_amt chequercd_amt*/

	
	
	
if($UsQLk){
	header('location:'.$home_path.'/transaction/frontdesk/view-resettlement.php?msg=Data saved successfully!.');	
} else {
	header('location:'.$home_path.'/transaction/frontdesk/view-resettlement.php?msg=Error in insertion');
}


?>