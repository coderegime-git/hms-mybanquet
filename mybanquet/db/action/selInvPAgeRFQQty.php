<?php  
session_start();
include("../config.php");
include("../util.php");
include("../amountToWords.php");

$conRFQ=$_GET['conRFQ'];

$convRate=$_GET['convRate'];


	

$sql=mysql_query("select * from customer_po where rfq_no='$conRFQ'");
if(mysql_num_rows($sql)>0){
$row=mysql_fetch_array($sql);
$totVal=$row['order_value'];
$totQy=$row['total_qty'];
$clQty=$row['clin_qty'];
$eachPrc=floatval($totVal/$totQy);
$clnPrc=floatval($eachPrc*$clQty);
$totInr=floatval($totVal*$convRate);


	$NETpAYy=$totInr;
	$aWords = new Currency();
	$finTot =$NETpAYy;
	/* $finInWords =strtoupper($aWords->get_bd_amount_in_text(round($finTot,2)));   */
	$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($finTot,2)));  
	/* echo $finInWords; */ 
	


echo $row['clin_dest'].','.$row['clin_qty'].','.$row['order_value'].','.$row['total_qty'].','.$eachPrc.','.$clnPrc.','.$finInWords;  
}else{
	echo 1;
}
	
?>