<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqlAR="insert into ar_bills(cur_date,bill_date,bill_no,vendor_code,bill_amount,arreceipt_no,cash,card,cheque,neft,commission,disc,balance,adjusted_on,adjusted_by,remarks,status,added_by,added_on)";
		$sqlAR.=" values(";
		$sqlAR.="'".$_POST['cur_date']."',";
		$sqlAR.="'".$_POST['bill_date']."',";
		$sqlAR.="'".$_POST['bill_no']."',";
		$sqlAR.="'".$_POST['vendor_code']."',";
		$sqlAR.="'".$_POST['bill_amount']."',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'Null',";
		$sqlAR.="'".$_POST['remarks']."',";
		$sqlAR.="'1',";
		$sqlAR.="'".$added_by."',";
		$sqlAR.="'".$added_on."')";
		/* echo $sqlAR;
		die();  */ 
		$UsQueCy =mysql_query($sqlAR);

	if($UsQueCy){
		header('location:'.$home_path.'/transaction/frontdesk/opening_balance.php?msg=Date saved successfully!');
	}
	else{
		header('location:'.$home_path.'/transaction/frontdesk/opening_balance.php?msg=Error in insertion');
	}


	
?>