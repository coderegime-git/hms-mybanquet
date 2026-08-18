<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$hid_regsp=$_POST['hid_menu'];
$hidRrR=trim($hid_regsp, ',');
$rmNSpt=explode(',',$hidRrR);
$cd=0;

$sqlS=mysql_query("select * from bq_gennextvalue where field='billno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$blNo=$rowS['currvalue']+1;

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['booking_no']."' and fpno='".$_POST['fp_no']."' AND confirm_status!='7'");
$rowb=mysql_fetch_array($sqlb);

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$sqlm=mysql_query("select * from bq_opvchrhdr where vouchrno='".$_POST['voucher_no']."' and bill_status='1'");
$row=mysql_fetch_array($sqlm);

for($ia=0;$ia<count($rmNSpt);$ia++) {
	
	if($ia==0){	
		$rcAMt=0;
		for($cd=0;$cd<count($_POST['receipt_amount']);$cd++){
			$rcAMt+=$_POST['receipt_amount'][$cd];
		}
	}else{
		$rcAMt=0;
	}
	
	$blNum=$prefix.str_pad($blNo,5,"0",STR_PAD_LEFT );


/* START VCHR TAX DETAILS */	
	 $sqlrr=mysql_query("select * from bq_opvchrdtl where split!='' AND split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3'");
	$nmWs=mysql_num_rows($sqlrr);
	$ab=0;$valu=0;$txAM=0;$dsAM=0;
	while($rowrr=mysql_fetch_array($sqlrr)){
	$sSum=mysql_fetch_array(mysql_query("select SUM(line_total)AS lnTot,SUM(tax_amt)AS TxTot,SUM(discamt)AS dsTot from bq_opvchrdtl where split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3'"));

		$valu=sprintf("%01.2f",$sSum['lnTot']);
		$txAM=sprintf("%01.2f",$sSum['TxTot']);
		$dsAM=sprintf("%01.2f",$sSum['dsTot']);

		$sv=mysql_query("select * from bq_opvchrdtl where split!='' AND split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3' ");
		while($rvv=mysql_fetch_array($sv)) {

		$sRt=(mysql_query("select * from bq_opvchrdtl where split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND item_name='".$rvv['item_name']."' AND bill_status!='3'"));
			while($rv=mysql_fetch_array($sRt)){
				
				$sqF=mysql_query("select * from bq_taxstruct where str_code='".$rowrr['taxstruccode']."' AND status='1'");
				while($roF=mysql_fetch_array($sqF)){
							$itmTot=$rv['line_total']-$rv['discamt'];
							$txVal=$itmTot*$roF['factor_value']/100;
					
						$rem="";
						$blN="";
						$sts="1";
						
				 /* $sqll="UPDATE bq_opvchrtaxdtl SET ";
					$sqll=$sqll."vouchrno='".$_POST['voucher_no']."',";
					$sqll=$sqll."vchrdate='".$curDate."',";
					$sqll=$sqll."item_code='".$rv['item_code']."',";
					$sqll=$sqll."item_name='".$rv['item_name']."',";
					$sqll=$sqll."taxcode='".$roF['tax_code']."',";
					$sqll=$sqll."taxableamt='".$itmTot."',";
					$sqll=$sqll."taxamt='".$txVal."',";
					$sqll=$sqll."billno='".$blNum."',";
					$sqll=$sqll."bill_status='".$sts."'";
					$sqll=$sqll." where taxcode='".$roF['tax_code']."' AND item_name='".$rv['item_name']."' AND vouchrno='".$_POST['voucher_no']."'";
					mysql_query($sqll); */ 		
				}
			}	
		}
	} 
/* END VCHR TAX DETAILS */



/* START Bill Tax Details */
$sqBl=mysql_query("select * from bq_opvchrdtl where split!='' AND split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3'");
	$nmWss=mysql_num_rows($sqBl);
	while($rwr=mysql_fetch_array($sqBl)){
		$sqF=mysql_query("select * from bq_taxstruct where str_code='".$rwr['taxstruccode']."' AND status='1'");
		while($roF=mysql_fetch_array($sqF)){
	
		$lnTot=$rwr['line_total']-$rwr['discamt'];
		$txVal=$lnTot*$roF['factor_value']/100; 
$sts='1';		
		$sqll="insert into bq_opbilltaxdtl(vouchrno,vchrdate,booking,item_code,item_name,taxstruccode,taxcode,taxamt,billno,bill_status,added_by,added_on)";	
		$sqll.=" values(";
		$sqll.="'".$_POST['voucher_no']."',";
		$sqll.="'".$curDate."',";
		$sqll.="'".$_POST['booking_no']."',";
		$sqll.="'".$rwr['item_code']."',";
		$sqll.="'".$rwr['item_name']."',";
		$sqll.="'".$rwr['taxstruccode']."',";
		$sqll.="'".$roF['tax_code']."',";
		$sqll.="'".$txVal."',";
		$sqll.="'".$blNum."',";
		$sqll.="'".$sts."',";
		$sqll.="'".$added_by."',";
		$sqll.="'".$added_on."')";
		/* echo $sqll; */
		$UsQuery =mysql_query($sqll);
		
		}
}
/* END Bill Tax Details */		
		
		
/* START Bill Header Details */	
$blAMTTx=$valu-$dsAM;

$bqv=mysql_fetch_array(mysql_query("select * from bq_opvchrdtl where split!='' AND split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3' "));

$pdO='0';
$sts='1';

$sqlbb=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['booking_no']."' and fpno='".$_POST['fp_no']."' AND confirm_status!='7'");
$rowbb=mysql_fetch_array($sqlbb);

if(isset($_POST['bl_title'][$ia]) && $_POST['bl_title'][$ia]!=""){
	$bl_title=$_POST['bl_title'][$ia];
}else{
	$bl_title=$rowbb['title'];
}

if(isset($_POST['bl_name'][$ia]) && $_POST['bl_name'][$ia]!=""){
	$bl_name=$_POST['bl_name'][$ia];
}else{
	$bl_name=$rowbb['guest_name'];
}

if(isset($_POST['bl_addr'][$ia]) && $_POST['bl_addr'][$ia]!=""){
	$bl_addr=$_POST['bl_addr'][$ia];
}else{
	$bl_addr=$rowbb['address1'];
}

if(isset($_POST['bl_addr1'][$ia]) && $_POST['bl_addr1'][$ia]!=""){
	$bl_addr1=$_POST['bl_addr1'][$ia];
}else{
	$bl_addr1=$rowbb['address2'];
}
if(isset($_POST['bl_city'][$ia]) && $_POST['bl_city'][$ia]!=""){
	$bl_city=$_POST['bl_city'][$ia];
}else{
	$bl_city=$rowbb['city'];
}
if(isset($_POST['bl_pin'][$ia]) && $_POST['bl_pin'][$ia]!=""){
	$bl_pin=$_POST['bl_pin'][$ia];
}else{
	$bl_pin=$rowbb['pin'];
}
if(isset($_POST['gst_no'][$ia]) && $_POST['gst_no'][$ia]!=""){
	$gst_no=$_POST['gst_no'][$ia];
}else{
	$gst_no=$rowbb['gstin']; 
}

$sqr=mysql_fetch_array(mysql_query("select SUM(taxamt)AS facT from bq_opbilltaxdtl where taxcode='SGST 9' AND billno='".$blNum."' AND bill_status='1'"));
$UTGST=sprintf("%01.2f",$sqr['facT']);

$sqrCg=mysql_fetch_array(mysql_query("select SUM(taxamt)AS facT from bq_opbilltaxdtl where taxcode='CGST 9' AND billno='".$blNum."' AND bill_status='1'"));
$CGST=sprintf("%01.2f",$sqrCg['facT']);
$bllT=floatval($valu)+floatval($UTGST)+floatval($CGST)-floatval($dsAM)-floatval($rcAMt);
$blAMT=sprintf("%01.2f",$bllT);
$tableamt=floatval($UTGST)+floatval($CGST);
$sql="insert into bq_opbillhdr(bill_no,bill_date,bkno,venue,session,funct,bkdate,fpno,fpdate,gpax,title,fname,lname,add1,add2,city,pin,gst_no, 	remarks,bill_status,nontaxableamt,taxableamt,discamt,advamt,paidout,sgst,cgst,billamt,roundoff,reprintno,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$blNum."',";
	 $sql.="'".$curDate."',";
	 $sql.="'".$row['bkno']."',";
	 $sql.="'".$rowb['venue']."',";
	 $sql.="'".$rowb['session']."',";
	 $sql.="'".$rowb['funct']."',";
	 $sql.="'".$row['bkdate']."',";
	 $sql.="'".$row['fpno']."',";
	 $sql.="'".$row['fpdate']."',";
	 $sql.="'".$rowb['guaranted']."',";
	 $sql.="'".mysql_real_escape_string($bl_title)."',";
	 $sql.="'".mysql_real_escape_string($bl_name)."',";
	 $sql.="'".mysql_real_escape_string($bl_name)."',";
	 $sql.="'".mysql_real_escape_string($bl_addr)."',";
	 $sql.="'".mysql_real_escape_string($bl_addr1)."',";
	 $sql.="'".mysql_real_escape_string($bl_city)."',";
	 $sql.="'".mysql_real_escape_string($bl_pin)."',";
	 $sql.="'".mysql_real_escape_string($gst_no)."',";
	 $sql.="'".$rowb['remarks']."',";
	 $sql.="'".$sts."',";
	 $sql.="'".$valu."',";
	 $sql.="'".$tableamt."',";
	 $sql.="'".$dsAM."',";
	 $sql.="'".$rcAMt."',";
	 $sql.="'".$pdO."',";
	 $sql.="'".$UTGST."',";
	 $sql.="'".$CGST."',";
	 $sql.="'".$blAMT."',";
	 $sql.="'".$pdO."',";
	 $sql.="'".$pdO."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
	 $UsQuery =mysql_query($sql);
	 
/* END Bill Header Details */		


/* START Bill Head Details Details */		
$svb=mysql_query("select * from bq_opvchrdtl where split!='' AND split='".@$rmNSpt[$ia]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3' ");
while($rv=mysql_fetch_array($svb)) {

$sqlm=mysql_query("select * from bq_opvchrhdr where vouchrno='".$_POST['voucher_no']."' AND bill_status!='3'");
$row=mysql_fetch_array($sqlm);
 
$sqMl=mysql_query("select * from bq_opfpmenudetail where fpno='".$_POST['fp_no']."' AND itemcode='".$rv['item_code']."' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqMl);
$temp="";
$blsts="";

$svd=mysql_query("select * from bq_opvchrdtl where vouchrno='".$_POST['voucher_no']."' AND item_name='".$rv['item_name']."' AND bill_status!='3'");
$rvd=mysql_fetch_array($svd);

$sqF=mysql_query("select SUM(factor_value)AS fac from bq_taxstruct where str_code='".$rv['taxstruccode']."' AND status='1'");
$roF=mysql_fetch_array($sqF);
$lnVal=floatval($rv['line_total'])-floatval($rv['discamt']);
$txAmt=$lnVal*$roF['fac']/100;

/* $linetotal=floatval($_POST['item_rate'][$cc]*$_POST['item_rate'][$cc]); */
/* $sqFf=mysql_query("select * from bq_menumaster where menu_code='".$rv['item_code']."'");
if(mysql_num_rows($sqFf)>0){
	$rqFf=mysql_fetch_array($sqFf);
	$menuGrp='menu';
$sqT=mysql_fetch_array(mysql_query("select * from bq_itemmaster where itmnu_code='".$rv['item_code']."'"));
$itmsub_cat=$sqT['itmsub_cat'];

}else {
$sqv=mysql_query("select * from bq_opkothdr where item_name='".$rv['item_name']."'");
	if(mysql_num_rows($sqv)>0){


$rqv=mysql_fetch_array($sqv);	
	$menuGrp=$rqv['subcatcode'];
	$itmsub_cat=$rqv['grpcode'];
}else{
	$menuGrp=$rvd['subcatcode'];
	$itmsub_cat=$rvd['grpcode'];
}
} */


if($rv['item_code']=='Hall'){
	$itmsub_cat='Hall';
}else{
	$sqFf=mysql_query("select * from bq_menumaster where menu_code='".$rv['item_code']."' and status='1'");
	if(mysql_num_rows($sqFf)>0){
		$rqFf=mysql_fetch_array($sqFf);
		$menuGrp='menu';
		$sqT=mysql_fetch_array(mysql_query("select * from bq_itemmaster where itmnu_code='".$rv['item_code']."' and status='1'"));
		$itmsub_cat=$sqT['menu_type'];

	}else {
		$sqv=mysql_query("select * from bq_opkothdr where item_name='".$rv['item_name']."' and kotstatus!='3'");
			if(mysql_num_rows($sqv)>0){
				$rqv=mysql_fetch_array($sqv);	
				$menuGrp=$rqv['subcatcode'];
				$itmsub_cat=$rqv['grpcode'];
		}else{
			$sqTt=mysql_fetch_array(mysql_query("select * from bq_itemmaster where item_name='".$rv['item_name']."' and status='1'"));
			if(mysql_num_rows($sqTt)>0){
				$rqFT=mysql_fetch_array($sqTt);
				$itmsub_cat=$rqFT['menu_type'];
				$menuGrp=$rqv['subcatcode'];
			}else{
				$menuGrp=$rvd['subcatcode'];
				$itmsub_cat=$rvd['grpcode'];
			}
		}
	}
}




	$sql="insert into bq_opbillhdtl(bill_no,bill_date,vouchrno,vchrdate,bkno,venue,session,funct,sac,itemcode,itemname,itemqty,itemrate,item_total,discamt,disccode,discperamt,discreason,taxstruccode,tax_amt,authorisedby,menugrp,subcatcode,catcode, grpcode,fpno,fpdate,bill_status)";
	$sql.=" values(";
	$sql.="'".$blNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['voucher_no']."',";
	$sql.="'".$row['vouchrdate']."',";
	 $sql.="'".$row['bkno']."',";
	 $sql.="'".$rowb['venue']."',";
	 $sql.="'".$rowb['session']."',";
	 $sql.="'".$rowb['funct']."',";
	 $sql.="'".$rv['sac']."',";
	$sql.="'".$rv['item_code']."',";
	$sql.="'".$rv['item_name']."',";
	$sql.="'".$rv['item_qty']."',";
	$sql.="'".$rv['item_rate']."',";
	$sql.="'".sprintf("%01.2f",$rv['line_total'])."',";
	$sql.="'".sprintf("%01.2f",$rv['discamt'])."',";
	$sql.="'".$rv['disccode']."',";
	$sql.="'".$rv['discperamt']."',";
	$sql.="'',";
	$sql.="'".$rv['taxstruccode']."',";
	$sql.="'".sprintf("%01.2f",$txAmt)."',";
	$sql.="'',";
	$sql.="'".$menuGrp."',";
	$sql.="'".$rvd['subcatcode']."',";
	$sql.="'".$rvd['catcode']."',";
	$sql.="'".$itmsub_cat."',";
	$sql.="'".$_POST['fp_no']."',";
	$sql.="'".$rowL['fpdate']."',";
	$sql.="'1')";
	$UsQuery =mysql_query($sql);
 }
/* END Bill Head Details Details */	 

/* START Bill Head Details ROUNDOFF Details */	
 $sqlP=mysql_query("select grace_time,rnd_value,round_off from property_definition");
				$rowp=mysql_fetch_array($sqlP);
				$graTime=$rowp['grace_time'];
				$rndVal=$rowp['rnd_value'];
				$round_off=$rowp['round_off'];
		$bal=$blAMT;

		$balaAmt=sprintf("%01.2f",$bal);
		$baAt=fmod($balaAmt, 1);
		
		$rmAmt=($rndVal-sprintf("%01.2f",$baAt));
		$remAMt=floatval($balaAmt)+floatval($rmAmt);
		$rmAmtRd="";
			if($round_off=='higher' && $baAt>=0.5) 
			{ 
				$rmAmtRd=$rmAmt;
				$remAMtT=floatval($balaAmt)+floatval($rmAmt);
			}else if($round_off=='higher' && $baAt<0.5) { 
				$rmAmtRd=sprintf("%01.2f",-$baAt);
				$remAMtT=floatval($balaAmt)-floatval($rmAmt); 
			}else if($round_off=='nearer' && $baAt>=0.5) { 
				$rmAmtRd=$rmAmt;
				$remAMtT=floatval($balaAmt)+floatval($rmAmt);
			}else if($round_off=='nearer' && $baAt<0.5){
				$rmAmtRd=-$baAt;
				$remAMtT=round($balaAmt);
			}
	
if($rmAmtRd!=0 && $rmAmtRd!="") {
	$crdt="";
	$settleflag='1';	
	
	$sql="insert into bq_opbillhdtl(bill_no,bill_date,vouchrno,vchrdate,itemcode,itemname,itemqty,itemrate,item_total,discamt,disccode,discperamt,discreason,taxstruccode,tax_amt,authorisedby,menugrp,subcatcode,catcode,grpcode,fpno,fpdate,bill_status)";
	$sql.=" values(";
	$sql.="'".$blNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['voucher_no']."',";
	$sql.="'".$row['vouchrdate']."',";
	$sql.="'RND',";
	$sql.="'Rounded off',";
	$sql.="'".$crdt."',";
	$sql.="'".sprintf("%01.2f",$rmAmtRd)."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'".$crdt."',";
	$sql.="'1')";
	/*  echo $sql; */ 
	$UsQuery =mysql_query($sql);
	
$bla=sprintf("%01.2f",$rmAmtRd)+floatval($blAMT);	

$sqbh=mysql_fetch_array(mysql_query("select SUM(item_total)-SUM(discamt)AS ttAmt,bill_no from bq_opbillhdtl where bill_no='".$blNum."' AND tax_amt>0 AND bill_status!='3' group by bill_no "));


$sqlLk="UPDATE bq_opbillhdr SET ";
$sqlLk=$sqlLk."taxableamt='".$sqbh['ttAmt']."',";
$sqlLk=$sqlLk."roundoff='".sprintf("%01.2f",$rmAmtRd)."',";
$sqlLk=$sqlLk."billamt='".round($bla)."'";
$sqlLk=$sqlLk." where bill_no='".$blNum."'";
/* echo $sqlLk; */
$UsQLk =mysql_query($sqlLk);


}
/* END Bill Head Details ROUNDOFF Details */

	
$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$blNo."'";
$sqlLk=$sqlLk." where field='billno'" ;
$UsQLk =mysql_query($sqlLk);
$blNo=$blNo+1;
$msg=$blNum.' generated!.';

$voucher_no=$_POST['voucher_no'];	
}

$voucher_no=$_POST['voucher_no'];
if($pid == '1'){
   $billtype='print-bqt-billing_cha.php';
   }else{
   $billtype='print-bqt-billing.php';
   }

if($UsQuery){
	$link = "<script>window.open('$home_path/transaction/view/$billtype?blN=$blNum&vucNo=$voucher_no', '_blank','width=1000,height=700')</script>";
	echo $link;
	$link1 = "<script>window.open('$home_path/transaction/frontdesk/settlement.php?vucNo=', '_self','')</script>";
	echo $link1;
}else {
header('location:'.$home_path.'/transaction/frontdesk/bqt_billing.php?msg=Error in insertion&vucNo=');
}


?>