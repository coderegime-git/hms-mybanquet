<?php  
ob_start();

include("../config.php");
$menu_code = isset($_GET['menu_code']) ? mysql_real_escape_string(trim($_GET['menu_code'])) : '';

$checkDet = mysql_query("select menu_code from bq_menugrp where menu_code='$menu_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
