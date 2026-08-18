<?php  
session_start();
include("../config.php");

$nsnNo=$_GET['nsnNo'];

/* $sqlCl=mysql_query("select * from unsuccessful_quotes where nsn_no='$nsnNo'");
$rowCl=mysql_fetch_array($sqlCl);
$award_whom=$rowCl['award_whom'];
echo $award_whom; */

/* $sqlCl=mysql_query("select * from quotation where nsn_no='$nsnNo'"); */
$sqlCl=mysql_query("select * from quotation where nsn_no='$nsnNo'");
if(mysql_num_rows($sqlCl)>0){
	$rowCl=mysql_fetch_array($sqlCl);
	echo 'RFQ'.$rowCl['rfq_no'];

}




?>








