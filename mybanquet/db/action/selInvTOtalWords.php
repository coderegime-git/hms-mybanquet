<?php  
session_start();
include("../config.php");
include("../util.php");
include("../amountToWords.php");

$invTotInr=$_GET['invTotInr'];


	$NETpAYy=$invTotInr;
	$aWords = new Currency();
	$finTot =$NETpAYy;
	/* $finInWords =strtoupper($aWords->get_bd_amount_in_text(round($finTot,2)));   */
	$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($finTot,2)));  
	echo $finInWords;   
?>