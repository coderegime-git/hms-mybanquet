<?php  
ob_start();

include("../config.php");
$submenu_code = isset($_GET['submenu_code']) ? mysql_real_escape_string(trim($_GET['submenu_code'])) : '';

$checkDet = mysql_query("select submenu_code from bq_submenugrp where submenu_code='$submenu_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
