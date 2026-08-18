<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$fpno=trim($_POST['fp_no']);
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

$sqV=mysql_query("select bkno,fpno from bq_opvchrhdr where vouchrno='".$rmw['vouchrno']."'");
$rmV=mysql_fetch_array($sqV);
$vouno=$rmw['vouchrno'];

$sG=mysql_query("select * from guest_register where room_no='".$_POST['room_desc']."' AND bill_status='1'");
$rt=mysql_fetch_array($sG);
$guestreg_id=$rt['guestreg_id'];
$guest_name=$rt['guest_name'];

$sqS=mysql_query("select hallbook_id from bq_opfpmenuhdr where fpno='".$rmV['fpno']."'");
$rmS=mysql_fetch_array($sqS);

$bankname='';
$flg='1';

$sqlb="insert into bq_opbillstldtl(bill_no,bill_date, 	fpno,vouchrno,bkno,hallbook_id,billamt,cash,card,company,upi,cheque,neft,room,refund,void,roomno,reg_num,guest_name,card_desc,upi_desc,ccno,compcode,compname,chqno,chqdate,bankname,neftdetails,tips,remarks,settleflag,added_by,added_on)";
$sqlb.=" values(";
	$sqlb.="'".$_POST['blno']."',";	
	$sqlb.="'".$adtCurDt."',";	
	$sqlb.="'".$fpno."',";	
	$sqlb.="'".$rmw['vouchrno']."',";	
	$sqlb.="'".$rmV['bkno']."',";	
	$sqlb.="'".$rmS['hallbook_id']."',";	
	$sqlb.="'".$_POST['bill_amt']."',";	
	$sqlb.="'".$_POST['cashrcd_amt']."',";	
	$sqlb.="'".$_POST['cardrcd_amt']."',";	
	$sqlb.="'".$_POST['comprcd_amt']."',";
    $sqlb.="'".$_POST['upircd_amt']."',";	
	$sqlb.="'".$_POST['chequercd_amt']."',";	
	$sqlb.="'".$_POST['neftrcd_amt']."',";	
	$sqlb.="'".$_POST['roomrcd_amt']."',";	
	$sqlb.="'".$_POST['refundrcd_amt']."',";	
	$sqlb.="'".$_POST['voidrcd_amt']."',";	
	$sqlb.="'".$_POST['room_desc']."',";	
	$sqlb.="'".$guestreg_id."',";	
	$sqlb.="'".$guest_name."',";	
	$sqlb.="'".$_POST['card_desc']."',";
    $sqlb.="'".$_POST['upi_desc']."',";	
	$sqlb.="'".$_POST['card_rem']."',";	
	$sqlb.="'".$comCode."',";	
	$sqlb.="'".$comName."',";	
	$sqlb.="'".$_POST['cheq_rem']."',";	
	$sqlb.="'".$_POST['cheq_desc']."',";
	$sqlb.="'".$_POST['neft_desc']."',";
	$sqlb.="'".$_POST['neft_rem']."',";
	$sqlb.="'".$_POST['hid_tips']."',";	
	$sqlb.="'".$_POST['hid_menu']."',";	
	$sqlb.="'".$flg."',";	
	$sqlb.="'".$added_by."',";
	$sqlb.="'".$added_on."')";
/* echo $sqlb;
die(); */
	$UsQLk =mysql_query($sqlb); 



if($_POST['voidrcd_amt']>0){
	$sqlLk="UPDATE bq_opbillhdr SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk); 
	
	$sqlLk="UPDATE bq_opbillhdtl SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);
}

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
	$sql.="'".$_POST['blno']."',";
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







$sbB=mysql_query("select * from bq_hallbooking where booking_no='".$rmV['bkno']."'");
$rwB=mysql_fetch_array($sbB);
$bkd=explode('/',$rwB['book_date']);
$frm=$bkd[2].'-'.$bkd[1].'-'.$bkd[0];

	
	$sqlLk="UPDATE bq_opfpmenudetail SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$fpno."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opfpmenuhdr SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$fpno."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);
	
	$sqlLk="UPDATE bq_opfpdeptinst SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$fpno."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opkothdr SET ";
	$sqlLk=$sqlLk."kotstatus='2'";
	$sqlLk=$sqlLk." where fpno='".$fpno."' AND kotstatus='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrhdr SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where fpno='".$fpno."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrdtl SET ";
	$sqlLk=$sqlLk."billno='".$_POST['blno']."',";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where vouchrno='".$vouno."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrtaxdtl SET ";
	$sqlLk=$sqlLk."billno='".$_POST['blno']."',";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where vouchrno='".$vouno."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk);
	
	$sqlLk="UPDATE bq_opbillhdr SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk); 
	
	$sqlLk="UPDATE bq_opbillhdtl SET ";
	$sqlLk=$sqlLk."bill_status='2'";
	$sqlLk=$sqlLk." where bill_no='".$_POST['blno']."' AND bill_status='1'" ;
	$UsQLk =mysql_query($sqlLk); 

$sqFb=mysql_query("select hallbook_id,bkno from bq_opfpmenuhdr where fpno='".$fpno."'");
$rmFb=mysql_fetch_array($sqFb);
	
	$sqlLk="UPDATE bq_hallresvadv SET ";
	$sqlLk=$sqlLk."status='2'";
	$sqlLk=$sqlLk." where hallbook_id='".$rmFb['hallbook_id']."' AND booking_no='".$rmFb['bkno']."' AND status='1'" ;
	$UsQLk =mysql_query($sqlLk);
	
if($UsQLk){
	//header('location:'.$home_path.'/transaction/frontdesk/settlement.php?msg=Data saved successfully!.');
	header('location:'.$home_path.'/transaction/view/print-bqt-billing_cha.php?blN='.$_POST['blno'].'&vucNo='.$vouno.'&msg=Data saved successfully!.');
} else {
	header('location:'.$home_path.'/transaction/frontdesk/settlement.php?msg=Error in insertion');
}


?>