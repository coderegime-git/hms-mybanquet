<?php  
ob_start();

include("../config.php");
$submenu_name = isset($_GET['submenu_name']) ? mysql_real_escape_string(trim($_GET['submenu_name'])) : '';

$checkDet = mysql_query("select submenu_name from bq_submenugrp where submenu_name='$submenu_name'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
