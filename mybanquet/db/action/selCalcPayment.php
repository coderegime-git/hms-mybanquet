<?php  
session_start();
include("../config.php");

$ebs_invno=$_GET['ebs_invno'];
$payAmount=$_GET['payAmount'];

$PaidTOT="";
$sqlPT=mysql_query("select * from invoice_payment where ebsinv_no='$ebs_invno'");
while($rowPT=mysql_fetch_array($sqlPT)){
	$PaidTOT+= intval($rowPT['payment_amount']);
	$inv_amount= intval($rowPT['inv_amount']);
}
$TOTpAID=$PaidTOT+$payAmount;

/*  echo $TOTpAID.$PaidTOT.'gfg'.$inv_amount;  */
if($TOTpAID>$inv_amount){
/* 	echo "Total invoice amount is $inv_amount previous paid amount $PaidTOT"; */
	echo "Payment amount greater than invoice amount $inv_amount. Previous paid amount $PaidTOT";
}

/*  $cur_date=$rowPT['cur_date'];
	$vendor_name=$rowPT['vendor_name'];
	$total_amount=$rowPT['total_amount']; */

/* echo $cur_date.','.$vendor_name.','.$total_amount;  */ 
?>








