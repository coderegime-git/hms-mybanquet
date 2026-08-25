<?php  
ob_start();

include("../config.php");
$mscode = isset($_GET['mscode']) ? mysql_real_escape_string(trim($_GET['mscode'])) : '';

$checkDet = mysql_query("select mscode from bq_marketseg where mscode='$mscode'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>