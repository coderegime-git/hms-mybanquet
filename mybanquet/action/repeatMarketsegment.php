<?php  
ob_start();

include("../config.php");
$mscode=$_GET['mscode'];

$checkDet=mysql_query("select mscode from bq_marketseg where mscode='$mscode'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>