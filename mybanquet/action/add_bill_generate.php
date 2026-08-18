<?php
ob_start();

include("../config.php");
include("../util.php");
$added_by=$_SESSION['user'];
$added_on=date('Y-m-d H:i:s');

$billNo=getCheckOutBillNumber();
$date=Date("d-m-Y");

if($_POST['pay_mode']=='cash'){
	$payMde='cash';
}else{
	$payMde='Null';
}	

if($_POST['pay_mode']=='credit'){
$payMdeC='credit';
}else{
$payMdeC='Null';
}

$sqlS=mysql_query("select * from company_master where vendor_name='".$_POST['vendor_code']."'");
$rowS=mysql_fetch_array($sqlS);
$vendor_code=$rowS['vendor_code'];

/* if($_POST['pay_mode']=='credit'){ */
$sqlCy="insert into ar_bills(cur_date,bill_date,bill_no,vendor_code,bill_amount,arreceipt_no,cash,credit,cheque,neft,commission,disc,balance,adjusted_on,adjusted_by,remarks,status,added_by,added_on)";
		$sqlCy.=" values(";
		$sqlCy.="'".$date."',";
		$sqlCy.="'".$_POST['bill_date']."',";
		$sqlCy.="'".$billNo."',";
		$sqlCy.="'".$vendor_code."',";
		$sqlCy.="'".$_POST['balance_amt']."',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'1',";
		$sqlCy.="'".$added_by."',";
		$sqlCy.="'".$added_on."')";
		/* echo $sqlCy;
		die(); */
		$UsQueCy =mysql_query($sqlCy);
/* }	 */	
		

$settleflag='1';

$sqlh="insert into bill_header(bill_no,bill_date,bill_amt,pay_mode,vendor_code,vendor_name,settleflag,added_by,added_on)";
		$sqlh.=" values(";
		$sqlh.="'".$billNo."',";
		$sqlh.="'".$_POST['bill_date']."',";
		$sqlh.="'".$_POST['balance_amt']."',";
		$sqlh.="'credit',";
		$sqlh.="'".strtoupper($vendor_code)."',";
		$sqlh.="'".$_POST['vendor_code']."',";
		$sqlh.="'".$settleflag."',";
		$sqlh.="'".$added_by."',";
		$sqlh.="'".$added_on."')";
		/* echo $sqlh;
		die(); */
		$UsQueryew =mysql_query($sqlh);





$particular=$_POST['particular'];
for($cc=0;$cc<count($particular);$cc++){
	if($_POST['particular'][$cc]!=""){
		$sqlb="insert into bill_detail(bill_no,bill_date,particulars,patch,qty,rate,  amount,cash,card,cheque,neft,cddet,vendor_code,vendor_name,added_by,added_on)";
			$sqlb.=" values(";
			$sqlb.="'".$billNo."',";
			$sqlb.="'".$_POST['bill_date']."',";
			$sqlb.="'".$_POST['particular'][$cc]."',";
			$sqlb.="'".$_POST['patch_no'][$cc]."',";
			$sqlb.="'".$_POST['qty'][$cc]."',";
			$sqlb.="'".$_POST['rate'][$cc]."',";
			$sqlb.="'".$_POST['amount'][$cc]."',";
			$sqlb.="'Null',";
			$sqlb.="'credit',";
			$sqlb.="'Null',";
			$sqlb.="'Null',";
			$sqlb.="'Null',";
			$sqlb.="'".strtoupper($vendor_code)."',";
			$sqlb.="'".$_POST['vendor_code']."',";
			$sqlb.="'".$added_by."',";
			$sqlb.="'".$added_on."')";
			/* echo $sqlb;
			die(); */
			$UsQuery =mysql_query($sqlb);
	}
}


	if($UsQuery){
		 header('location:'.$home_path.'/transaction/frontdesk/ar_receipts.php?msg=Data saved'); 
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/ar_receipts.php?msg=Error in insertion');
	}
	
?>















