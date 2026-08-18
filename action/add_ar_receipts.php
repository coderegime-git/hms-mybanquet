<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqlAR="insert into ar_receipts(rcpt_date,rcpt_no,vendor_code,amount,pay_mode,cheque_num,cheque_date,remarks,status,added_by,added_on)";
		$sqlAR.=" values(";
		$sqlAR.="'".$_POST['rcpt_date']."',";
		$sqlAR.="'".$_POST['rcpt_no']."',";
		$sqlAR.="'".$_POST['vendor_code']."',";
		$sqlAR.="'".$_POST['amount']."',";
		$sqlAR.="'".$_POST['pay_mode']."',";
		$sqlAR.="'".$_POST['cheque_num']."',";
		$sqlAR.="'".$_POST['cheque_date']."',";
		$sqlAR.="'".$_POST['remarks']."',";
		$sqlAR.="'1',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		/* echo $sqlAR;
		die(); */   
		$UsQueCy =mysql_query($sqlAR);

	if($UsQueCy){
		header('location:'.$home_path.'/transaction/frontdesk/payment_receivable.php?msg=Date saved successfully!');
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/payment_receivable.php?msg=Error in insertion');
	}


	
?>