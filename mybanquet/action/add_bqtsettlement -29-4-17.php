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

$bankname='';
$flg='1';

$sqlb="insert into bq_opbillstldtl(bill_no,bill_date, 	fpno,billamt,settledamt,settlemode,compcode,bankname,chqno,chqdate,ccno,roomno,remarks,settleflag,added_by,added_on)";
$sqlb.=" values(";
	$sqlb.="'".$_POST['blno']."',";	
	$sqlb.="'".$adtCurDt."',";	
	$sqlb.="'".$_POST['fp_no']."',";	
	$sqlb.="'".$_POST['bill_amt']."',";	
	$sqlb.="'".$_POST['balance']."',";	
	$sqlb.="'".$_POST['pay_mode']."',";	
	$sqlb.="'".$compdesc."',";	
	$sqlb.="'".$bankname."',";	
	$sqlb.="'".$_POST['cheq_desc']."',";	
	$sqlb.="'".$_POST['cheq_desc']."',";	
	$sqlb.="'".$_POST['cheq_tips']."',";	
	$sqlb.="'".$room_desc."',";	
	$sqlb.="'".$_POST['hid_menu']."',";	
	$sqlb.="'".$flg."',";	
	$sqlb.="'".$added_by."',";
	$sqlb.="'".$added_on."')";

	mysql_query($sqlb); 





if(isset($_POST['comp_desc']) && $_POST['comp_desc']!=''){
	 $sts="";
$sqlCy="insert into ar_bills(	bill_date,bill_no,room_no,reg_num,guest_name,comp_code,comp_name,bill_amount,arreceipt_no,cash,card,cheque,neft,commission,disc,balance,adjusted_on,adjusted_by,remarks,status,added_by,added_on)";
		$sqlCy.=" values(";
		$sqlCy.="'".$adtCurDt."',";
		$sqlCy.="'".$_POST['blno']."',";
		$sqlCy.="'".$_POST['room_desc']."',";
		$sqlCy.="'".$sts."',";
		$sqlCy.="'".$_POST['guest_name']."',";
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
		$sqlCy.="'".$_POST['bill_amt']."',";
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



$room_no=$_POST['room_desc'];
$guestName=$_POST['guest_name'];
$roomNum=$_POST['room_desc'];
$payMode=$_POST['pay_mode'];

/* if($_POST['cashrcd_amt']!=""){
	$refunDAmt=$_POST['cashrcd_amt'];
}else if($_POST['cardrcd_amt']!=""){
	$refunDAmt=$_POST['cardrcd_amt'];
}else if($_POST['cheqrcd_amt']!=""){
	$refunDAmt=$_POST['cheqrcd_amt'];
}else if($_POST['neftrcd_amt']!=""){
	$refunDAmt=$_POST['neftrcd_amt'];
}else if($_POST['refnd_amt']!=""){
	$refunDAmt=$_POST['refnd_amt'];
} */

/* if($_POST['refundrcd_amt']!='' && $_POST['refundrcd_amt']!='0'){
$sqlGT=mysql_query("select distinct reg_num from guest_trans where room_no='".$_POST['room_desc']."' AND bill_status='1'");
$rowGT=mysql_fetch_array($sqlGT);

$sql="insert into refund(cur_date,reg_num,bill_no,prefix,voucher_no,room_no,guest_name,amount,pay_mode,remarks,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$adtCurDt."',";
	$sql.="'".$_POST['regNm']."',";
	$sql.="'".$_POST['bill_no']."',";
	$sql.="'RF',";
	$sql.="'".getRefundNumber()."',";
	$sql.="'".$_POST['room_desc']."',";
	$sql.="'".$_POST['guest_name']."',";
	$sql.="'".$_POST['refundrcd_amt']."',";
	$sql.="'refund',";
	$sql.="'".$_POST['pdoutremarks']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

$UsQuerrf =mysql_query($sql); 
$chuid = mysql_insert_id();
		$sqlLk="UPDATE gennext_value SET ";
		$sqlLk=$sqlLk."currvalue='".getRefundNumber()."'";
		$sqlLk=$sqlLk." where field='refund'" ;
		$UsQLk =mysql_query($sqlLk); 
} */


if($_POST['cashrcd_amt']!=""){
	$recvdAMt=$_POST['cashrcd_amt'];
}else if($_POST['refnd_amt']!=""){
	$recvdAMt=$_POST['refnd_amt'];
} 




/* START Room Settlement */
$sqGt=mysql_query("select * from guest_register where room_no='".$_POST['room_desc']."' AND bill_status='1'");
if(mysql_num_rows($sqGt)>0){
$rowGt=mysql_fetch_array($sqGt);
/* echo $_POST['roomrcd_amt'];
die(); */	
if($_POST['roomrcd_amt']>0){
	
$sqlLD=mysql_query("select * from ledgers where ledger_code='dr' AND status='1'");
$rowLD=mysql_fetch_array($sqlLD);

$split="";

 $sqlT="insert into guest_trans(reg_num,gstreg_id,gst_name,room_no,ref_no,slno,receipt_no,reserv_no,roombook_id,	guest_type,rev_desc,tax_val,debit,credit,trans_date,bill_status,bill_number,pay_mode,pay_details,remarks,split,tempbillno,added_by,added_on)";
	$sqlT.=" values(";
	$sqlT.="'".$rowGt['guestreg_id']."',";
	$sqlT.="'".$rowGt['guestreg_id']."',";
	$sqlT.="'".$rowGt['guest_name']."',";
	$sqlT.="'".$rowGt['room_no']."',";
	$sqlT.="'".$rowLD['ledger_id']."',";
	$sqlT.="'".$split."',";
	/* $sqlT.="'".getGuestTransSRNO()."',"; */
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
/* End Room Settlement */

	
	$sqlLk="UPDATE bq_opfpmenudetail SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opfpmenuhdr SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opkothdr SET ";
	$sqlLk=$sqlLk."kotstatus='2'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."' AND kotstatus='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrhdr SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrdtl SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrtaxdtl SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);
	
			
	$sqlLk="UPDATE bq_opbillhdr SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk); 
	
	
	
if($UsQLk){
	header('location:'.$home_path.'/transaction/frontdesk/settlement.php?msg=Data saved successfully!.');	
} else {
	header('location:'.$home_path.'/transaction/frontdesk/settlement.php?msg=Error in insertion');
}


?>