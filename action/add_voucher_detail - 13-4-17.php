<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlS=mysql_query("select * from bq_gennextvalue where field='vuchrno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$vucNo=$rowS['currvalue']+1;
$vucNum=$prefix.$vucNo;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$valu=0;
for($cc=0;$cc<count($_POST['item_value']);$cc++){
	$valu+=$_POST['item_value'][$cc];
}

$totVal=$valu*$_POST['total_pax'];
$sts='1';

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['booking_no']."'");
$rowb=mysql_fetch_array($sqlb);

$sqFp=mysql_query("select * from bq_opfpmenuhdr where bkno='".$_POST['booking_no']."' AND bill_status!='3'");
$roFp=mysql_fetch_array($sqFp);
$hallchrg=$roFp['hallchrg'];
$ratechrg=$roFp['ratechrg'];

$sqp=mysql_query("select SUM(factor_value)AS hlTx from bq_taxstruct where str_code='".$roFp['halltax']."' AND status='1'");
$rop=mysql_fetch_array($sqp);
$hlTotTax=$hallchrg*$rop['hlTx']/100;

$sqRt=mysql_query("select SUM(factor_value)AS rtTx from bq_taxstruct where str_code='".$roFp['ratetax']."' AND status='1'");
$roRt=mysql_fetch_array($sqRt);
$rTTotTax=$ratechrg*$roRt['rtTx']/100;


$sqM=mysql_query("select * from bq_opfpmenudetail where fpno='".$_POST['fp_no']."' AND bill_status!='3'");
$txVal=0;
while($roM=mysql_fetch_array($sqM)){  
	$sqF=mysql_query("select * from bq_taxstruct where str_code='".$roM['taxstructcode']."' AND status='1'");
	while($roF=mysql_fetch_array($sqF)){
		$itmVal=$roM['qty']*$roM['rate'];
		$txVal+=$itmVal*$roF['factor_value']/100;
	}
}
$totTxVl=$txVal+$rTTotTax+$hlTotTax;

$sqRA=mysql_query("select SUM(amount)AS advAmt from bq_hallresvadv where booking_no='".$_POST['booking_no']."' AND status!='3'");
$roRA=mysql_fetch_array($sqRA);
$advAmt=$roRA['advAmt'];

/* Start Voucher insert */
$VcAmt=$totVal+$totTxVl-$advAmt;
$discamt='0';
$paidout='0';
$rndof='0';
$sql="insert into bq_opvchrhdr(vouchrno,vouchrdate,bkno,bkdate,fpno,fpdate,gpax,fname, 	lname,add1,add2,city,pin,remarks,bill_status,nontaxableamt,taxableamt,discamt,advamt,paidout,vchramt,roundoff,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$vucNum."',";
	 $sql.="'".$curDate."',";
	 $sql.="'".$_POST['booking_no']."',";
	 $sql.="'".$rowb['book_date']."',";
	 $sql.="'".$_POST['fp_no']."',";
	 $sql.="'".$roFp['fpdate']."',";
	 $sql.="'".$_POST['total_pax']."',";
	 $sql.="'".$rowb['guest_name']."',";
	 $sql.="'".$rowb['guest_name']."',";
	 $sql.="'".$rowb['address1']."',";
	 $sql.="'".$rowb['address2']."',";
	 $sql.="'".$rowb['city']."',";
	 $sql.="'".$rowb['pin']."',";
	 $sql.="'".$_POST['gst_comm']."',";
	 $sql.="'".$sts."',";
	 $sql.="'".$totVal."',";
	 $sql.="'".$totTxVl."',";
	 $sql.="'".$discamt."',";
	 $sql.="'".$advAmt."',";
	 $sql.="'".$paidout."',";
	 $sql.="'".$VcAmt."',";
	 $sql.="'".$rndof."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
$UsQuery =mysql_query($sql);
/* End Voucher insert */

for($cd=0;$cd<count($_POST['item_code']);$cd++){
	
if($_POST['item_code'][$cd]!=''){
$sqMl=mysql_query("select * from bq_opfpmenudetail where fpno='".$_POST['fp_no']."' AND itemcode='".$_POST['item_code'][$cd]."' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqMl);

$refno='';
$discamt='';
$disccode='';
$taxstruccode='';
$blNo='';
$sts='1';

$sql="insert into bq_opvchrdtl(vouchrno,refno,item_code,item_name,item_qty,item_rate,discamt,disccode, 	taxstruccode,subcatcode,catcode,grpcode,billno,bill_status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$vucNum."',";
	 $sql.="'".$refno."',";
	 $sql.="'".$_POST['item_code'][$cd]."',";
	 $sql.="'".$_POST['item_name'][$cd]."',";
	 $sql.="'".$_POST['item_qty'][$cd]."',";
	 $sql.="'".$_POST['item_rate'][$cd]."',";
	 $sql.="'".$discamt."',";
	 $sql.="'".$disccode."',";
	 $sql.="'".$rowL['taxstructcode']."',";
	 $sql.="'".$rowL['subcatcode']."',";
	 $sql.="'".$rowL['catcode']."',";
	 $sql.="'".$rowL['grpcode']."',";
	 $sql.="'".$blNo."',";
	 $sql.="'".$sts."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
	 /* echo $sql; */
	 $UsQuery =mysql_query($sql);
	}
	 
}

for($ce=0;$ce<count($_POST['item_code']);$ce++){
 $sqF=mysql_query("select * from bq_taxstruct where str_code='".$_POST['tax_code'][$ce]."' AND status='1'");
	while($roF=mysql_fetch_array($sqF)){
		
		$txVal=$_POST['item_value'][$ce]*$roF['factor_value']/100;
	
		$rem="";
		$blN="";
		$sql="insert into bq_opvchrtaxdtl(vouchrno,vchrdate,item_code,item_name,taxcode,taxableamt,taxamt,remarks,billno)";
		$sql.=" values(";
		$sql.="'".$vucNum."',";
		$sql.="'".$curDate."',";
		$sql.="'".$_POST['item_code'][$ce]."',";
		$sql.="'".$_POST['item_name'][$ce]."',";
		$sql.="'".$roF['tax_code']."',";
		$sql.="'".$_POST['item_value'][$ce]."',";
		$sql.="'".$txVal."',";
		$sql.="'".$rem."',";
		$sql.="'".$blN."')";
		  /* echo $sql; */ 
		$UsQuery =mysql_query($sql); 
	} 
}
/*  die(); */ 
 
	 


	 
	/* die();  */
$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$vucNo."'";
$sqlLk=$sqlLk." where field='vuchrno'" ;
$UsQLk =mysql_query($sqlLk);






if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher.php?msg=Error in insertion');
}


?>