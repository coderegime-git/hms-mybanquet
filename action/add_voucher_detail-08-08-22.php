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

$sqlbV=mysql_query("select * from bq_opvchrhdr where fpno='".$_POST['fp_no']."'AND bill_status='1'");
if(mysql_num_rows($sqlbV)>0){
/* $rowV=mysql_fetch_array($sqlbV); vuc_status */
	$vucsts='';
	$sqlLk="UPDATE bq_opfpmenuhdr SET ";
	$sqlLk=$sqlLk."vuc_status='".$vucsts."'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."'";
	//mysql_query($sqlLk);
	
	$sqlLk="UPDATE bq_opvchrhdr SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."'";
	//mysql_query($sqlLk);

	$sqlLk="UPDATE bq_opvchrdtl SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."'";
	//mysql_query($sqlLk);


	$sqlLk="UPDATE bq_opvchrtaxdtl SET ";
	$sqlLk=$sqlLk."bill_status='3'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."'";
	//mysql_query($sqlLk);
}

for($ce=0;$ce<count($_POST['item_name']);$ce++){
 $sqF=mysql_query("select * from bq_taxstruct where str_code='".$_POST['tax_code'][$ce]."' AND status='1' AND factor_value>0");
	while($roF=mysql_fetch_array($sqF)){
		
		$totItmVl=floatval($_POST['item_qty'][$ce])*floatval($_POST['item_rate'][$ce]);
		
		$txVal=$totItmVl*$roF['factor_value']/100;
	
		/* $txVal=$_POST['item_value'][$ce]*$roF['factor_value']/100; */
	
		$rem="";
		$blN="";
		$sts="1";
		
		$sql="insert into bq_opvchrtaxdtl(vouchrno,vchrdate,item_code,item_name,taxcode,taxableamt,taxamt,remarks,billno,bill_status)";
		$sql.=" values(";
		$sql.="'".$vucNum."',";
		$sql.="'".$curDate."',";
		$sql.="'".$_POST['item_code'][$ce]."',";
		$sql.="'".$_POST['item_name'][$ce]."',";
		$sql.="'".$roF['tax_code']."',";
		$sql.="'".sprintf("%01.2f",$totItmVl)."',";
		$sql.="'".sprintf("%01.2f",$txVal)."',";
		$sql.="'".$_POST['remarks']."',";
		$sql.="'".$blN."',";
		$sql.="'".$sts."')";
		   echo $sql; 
		//mysql_query($sql); 
	} 
}
  die(); 





for($cd=0;$cd<count($_POST['item_code']);$cd++){
	
if($_POST['item_code'][$cd]!=''){
$sqMl=mysql_query("select * from bq_opfpmenudetail where fpno='".$_POST['fp_no']."' AND itemcode='".$_POST['item_code'][$cd]."' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqMl);

$sqF=mysql_query("select SUM(taxamt)AS txA from bq_opvchrtaxdtl where item_code='".$_POST['item_code'][$cd]."' AND bill_status='1'");
$roF=mysql_fetch_array($sqF);
$txAmt=$roF['txA'];	
	
$refno='';
$discamt='';
$disccode='';
$discperamt='';
$taxstruccode='';
$blNo='';
$sptTemp='';
$spLT='1';
$sts='1';

$tot=$_POST['item_qty'][$cd]*$_POST['item_rate'][$cd];

/* $netAmt=$tot+$txAmt;
$totTxx=floatval($tot*0.18); */
$valu=0;
for($cc=0;$cc<count($_POST['item_value']);$cc++){
	$valu+=$_POST['item_value'][$cc];
}

$totVal=$valu;
$sqr=mysql_fetch_array(mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where tax_code='SGST 9' AND status='1'"));
$amtutgst=$totVal;
$UTGST=sprintf("%01.2f",$tot*$sqr['facT']/100);

$sqrCg=mysql_fetch_array(mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where tax_code='CGST 9' AND status='1'"));
$amtCgst=$totVal;
$CGST=sprintf("%01.2f",$tot*$sqr['facT']/100);

$totTxx=floatval($UTGST+$CGST);

$netAmt=$tot+$totTxx;

$sql="insert into bq_opvchrdtl(vouchrno,vouchrdate,refno,item_code,item_name,item_qty,item_rate,line_total,net_amount,discamt,disccode,discperamt, 	taxstruccode,tax_amt,subcatcode,catcode,grpcode,billno,split_temp,split,bill_status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$vucNum."',";
	 $sql.="'".$curDate."',";
	 $sql.="'".$refno."',";
	 $sql.="'".$_POST['item_code'][$cd]."',";
	 $sql.="'".$_POST['item_name'][$cd]."',";
	 $sql.="'".$_POST['item_qty'][$cd]."',";
	 $sql.="'".$_POST['item_rate'][$cd]."',";
	 $sql.="'".$tot."',";
	 $sql.="'".$netAmt."',";
	 $sql.="'".$discamt."',";
	 $sql.="'".$disccode."',";
	 $sql.="'".$discperamt."',";
	 $sql.="'".$_POST['tax_code'][$cd]."',";
	 $sql.="'".$totTxx."',";
	 $sql.="'".$_POST['subcatcode'][$cd]."',";
	 $sql.="'".$_POST['catcode'][$cd]."',";
	 $sql.="'".$_POST['grpcode'][$cd]."',";
	 $sql.="'".$blNo."',";
	 $sql.="'".$sptTemp."',";
	 $sql.="'".$spLT."',";
	 $sql.="'".$sts."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
	/*  echo $sql; */ 
	 $UsQuery =mysql_query($sql);
	}
	 
}
/* die(); */

 
	 


/* Start Voucher insert */	 


$totVal=$valu;
$sts='1';
$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['booking_no']."' AND confirm_status!='7'");
$rowb=mysql_fetch_array($sqlb);

$sCg=mysql_fetch_array(mysql_query("select hallbook_id from bq_opfpmenuhdr where fpno='".$_POST['fp_no']."'"));

$sqRA=mysql_query("select SUM(amount)+SUM(sgst)+SUM(cgst)AS advAmt,SUM(netamt)AS Adv from bq_hallresvadv where booking_no='".$_POST['booking_no']."' AND hallbook_id='".$sCg['hallbook_id']."' AND status!='3'");
$roRA=mysql_fetch_array($sqRA);
/* $advAmt=$roRA['advAmt']; */
$advAmt=$roRA['Adv'];

$sqtx=mysql_query("select SUM(taxamt)AS txAmt from bq_opvchrtaxdtl where vouchrno='".$vucNum."' AND bill_status!='3'");
$rotx=mysql_fetch_array($sqtx);
$totTxVl=sprintf("%01.2f",$rotx['txAmt']);

$sqMl=mysql_query("select * from bq_opfpmenuhdr where fpno='".$_POST['fp_no']."' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqMl);

$VcAmt=$totVal+$totTxVl-$advAmt;
$discamt='0';
$paidout='0';
$rndof='0';


$sqr=mysql_fetch_array(mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where tax_code='UTGST' AND status='1'"));
$amtutgst=$totVal;
$UTGST=sprintf("%01.2f",$amtutgst*$sqr['facT']/100);

$sqrCg=mysql_fetch_array(mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where tax_code='CGST' AND status='1'"));
$amtCgst=$totVal;
$CGST=sprintf("%01.2f",$amtCgst*$sqr['facT']/100);




$sql="insert into bq_opvchrhdr(vouchrno,vouchrdate,bkno,bkdate,fpno,fpdate,gpax,fname, 	lname,add1,add2,city,pin,remarks,bill_status,nontaxableamt,taxableamt,discamt,advamt,paidout,vchramt,sgst,cgst,roundoff,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$vucNum."',";
	 $sql.="'".$curDate."',";
	 $sql.="'".$_POST['booking_no']."',";
	 $sql.="'".$rowb['book_date']."',";
	 $sql.="'".$_POST['fp_no']."',";
	 $sql.="'".$rowL['fpdate']."',";
	 $sql.="'".$_POST['total_pax']."',";
	 $sql.="'".mysql_real_escape_string($rowb['guest_name'])."',";
	 $sql.="'".mysql_real_escape_string($rowb['guest_name'])."',";
	 $sql.="'".mysql_real_escape_string($rowb['address1'])."',";
	 $sql.="'".$rowb['address2']."',";
	 $sql.="'".$rowb['city']."',";
	 $sql.="'".$rowb['pin']."',";
	 $sql.="'".mysql_real_escape_string($_POST['remarks'])."',";
	 $sql.="'".$sts."',";
	 $sql.="'".$totVal."',";
	 $sql.="'".$totTxVl."',";
	 $sql.="'".$discamt."',";
	 $sql.="'".$advAmt."',";
	 $sql.="'".$paidout."',";
	 $sql.="'".$VcAmt."',";
	 $sql.="'".$UTGST."',";
	 $sql.="'".$CGST."',";
	 $sql.="'".$rndof."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
$UsQuery =mysql_query($sql);
/* End Voucher insert */

	$vucsts='1';
	$sqlLk="UPDATE bq_opfpmenuhdr SET ";
	$sqlLk=$sqlLk."vuc_status='".$vucsts."'";
	$sqlLk=$sqlLk." where fpno='".$_POST['fp_no']."'";
	mysql_query($sqlLk);
	
	
$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$vucNo."'";
$sqlLk=$sqlLk." where field='vuchrno'" ;
$UsQLk =mysql_query($sqlLk);

$msg=$vucNum.' generated!.';

if($UsQuery){
$link = "<script>window.open('$home_path/transaction/view/print-voucher-billing.php?vuNum=$vucNum', '_blank','width=1000,height=700')</script>";
echo $link;
$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-fpvoucher-details.php?fromdate=$curDate&todate=$curDate&val=', '_self','')</script>";
echo $link1;
/* $link1 = "<script>window.open('$home_path/transaction/frontdesk/view-fpvoucher-details.php?vucNo=', '_self','')</script>";
echo $link1; */
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher.php?msg=Error in insertion');
}


?>