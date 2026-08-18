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

$sqlb="insert into bq_opbillstldtl(bill_no,bill_date, 	fpno,vouchrno,bkno,billamt,cash,card,company,cheque,neft,room,refund,void,roomno,reg_num,guest_name,card_desc,ccno,compcode,compname,chqno,chqdate,bankname,neftdetails,tips,remarks,settleflag,added_by,added_on)";
$sqlb.=" values(";
	$sqlb.="'".$_POST['blno']."',";	
	$sqlb.="'".$adtCurDt."',";	
	$sqlb.="'".$_POST['fp_no']."',";	
	$sqlb.="'".$rmw['vouchrno']."',";	
	$sqlb.="'".$rmV['bkno']."',";	
	$sqlb.="'".$_POST['bill_amt']."',";	
	$sqlb.="'".$_POST['cashrcd_amt']."',";	
	$sqlb.="'".$_POST['cardrcd_amt']."',";	
	$sqlb.="'".$_POST['comprcd_amt']."',";	
	$sqlb.="'".$_POST['chequercd_amt']."',";	
	$sqlb.="'".$_POST['neftrcd_amt']."',";	
	$sqlb.="'".$_POST['roomrcd_amt']."',";	
	$sqlb.="'".$_POST['refundrcd_amt']."',";	
	$sqlb.="'".$_POST['voidrcd_amt']."',";	
	$sqlb.="'".$_POST['room_desc']."',";	
	$sqlb.="'".$guestreg_id."',";	
	$sqlb.="'".$guest_name."',";	
	$sqlb.="'".$_POST['card_desc']."',";	
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

/* Start Dashboard Hall Status Update */
$sbD=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y')='$frm' AND venue='".$rwB['venue']."'");
while($rRe=mysql_fetch_array($sbD)){
	$t6=explode(',',$rRe['tme6']);
	$t7=explode(',',$rRe['tme7']);
	$t8=explode(',',$rRe['tme8']);
	$t9=explode(',',$rRe['tme9']);
	$t10=explode(',',$rRe['tme10']);
	$t11=explode(',',$rRe['tme11']);
	$t12=explode(',',$rRe['tme12']);
	$t13=explode(',',$rRe['tme13']);
	$t14=explode(',',$rRe['tme14']);
	$t15=explode(',',$rRe['tme15']);
	$t16=explode(',',$rRe['tme16']);
	$t17=explode(',',$rRe['tme17']);
	$t18=explode(',',$rRe['tme18']);
	$t19=explode(',',$rRe['tme19']);
	$t20=explode(',',$rRe['tme20']);
	$t21=explode(',',$rRe['tme21']);
	$t22=explode(',',$rRe['tme22']);
	$t23=explode(',',$rRe['tme23']);
	$t24=explode(',',$rRe['tme24']);

	if($t6[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme6='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t7[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme7='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t8[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme8='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t9[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme9='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t10[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme10='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t11[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme11='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t12[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme12='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t13[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme13='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t14[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme14='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t15[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme15='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t16[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme16='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t17[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme17='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t18[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme18='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t19[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme19='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t20[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme20='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t21[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme21='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t22[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme22='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t23[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme23='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	if($t24[1]==$rmV['bkno']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme24='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$rwB['book_date']."' AND venue='".$rwB['venue']."'";
		mysql_query($sqll);
	}
	
}
/* End Dashboard Hall Status Update */





	
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